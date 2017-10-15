package jASUtils;

import java.io.*;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

import org.joda.time.DateTime;
import org.joda.time.DateTimeZone;
import org.joda.time.format.DateTimeFormat;
import org.joda.time.format.DateTimeFormatter;

import jASUtils.MyDBConnector;
import jASUtils.StumpJunk;
import jASUtils.ModelShare;

public class ModelImageOps {

	public static void main(String args[]) {

		final DateTime tDateTime = new DateTime(DateTimeZone.UTC).minusHours(4);
		final DateTimeFormatter getDateFormat = DateTimeFormat.forPattern("yyyyMMdd");
		final String getDate = getDateFormat.print(tDateTime);
		final File xml2Path = ModelShare.xml2Path;
		final String wwwOutBase = "/var/www/G2Out";
		final String stdRes = "2904x1440";
		final File focusMP4 = new File(xml2Path.getPath()+"/FOCUS_Loop.mp4");
		final File helpers = StumpJunk.helpers;
		final File hrrrMP4 = new File(xml2Path.getPath()+"/HRRR_Loop.mp4");
		final File memHRRR = new File(xml2Path.getPath()+"/tmpic/HRRR");
		final File memHRRRFocus = new File(xml2Path.getPath()+"/tmpic/FOCUS");
		final File wwwOutArchive = new File(wwwOutBase+"/MergedJ/Archive");
		final File wwwOutLoops = new File(wwwOutBase+"/MergedJ/Loops");
		final File wwwOutImages = new File(wwwOutBase+"/MergedJ/Images");
		final String getHour = args[0];
		final String modelRunString = getDate+"_"+getHour+"Z";

		wwwOutArchive.mkdirs();
		wwwOutLoops.mkdirs();
		wwwOutImages.mkdirs();
		memHRRR.mkdirs();
		memHRRRFocus.mkdirs();
		hrrrMP4.delete();
		focusMP4.delete();

		Thread io1a = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("rm "+xml2Path.getPath()+"/*js2tmp*"); }});
		Thread io1b = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+xml2Path.getPath()+"/*HRRR_* "+memHRRR.getPath()); }});
		Thread io1c = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+xml2Path.getPath()+"/FOCUS* "+memHRRRFocus.getPath()); }});
		Thread io1Pool[] = { io1a, io1b, io1c }; 
		for (Thread thread : io1Pool) { thread.start(); }
		for (int i = 0; i < io1Pool.length; i++) { try { io1Pool[i].join(); } catch (InterruptedException nx) { nx.printStackTrace(); } }

		StumpJunk.runProcess("rm "+wwwOutImages.getPath()+"/*.png");
		StumpJunk.runProcess("cp "+memHRRR.getPath()+"/*.png "+wwwOutImages.getPath());
		StumpJunk.runProcess("mogrify -format png -gravity center -crop "+stdRes+"+0+0 "+wwwOutImages.getPath()+"/*.png");

		Thread io2a = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("bash "+helpers.getPath()+"/Sequence.sh "+memHRRR.getPath()+" png"); }});
		Thread io2b = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("bash "+helpers.getPath()+"/Sequence.sh "+memHRRRFocus.getPath()+" png"); }});
		Thread io2Pool[] = { io2a, io2b }; 
		for (Thread thread : io2Pool) { thread.start(); }
		for (int i = 0; i < io2Pool.length; i++) { try { io2Pool[i].join(); } catch (InterruptedException nx) { nx.printStackTrace(); } }

		Thread io3a = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("ffmpeg -threads 8 -r 10 -i "+memHRRR.getPath()+"/%05d.png -vcodec libx264 -pix_fmt yuv420p "+hrrrMP4.getPath()); }});
		Thread io3b = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("ffmpeg -threads 8 -r 10 -i "+memHRRRFocus.getPath()+"/%05d.png -vcodec libx264 -pix_fmt yuv420p "+focusMP4.getPath()); }});
		Thread io3Pool[] = { io3a, io3b }; 
		for (Thread thread : io3Pool) { thread.start(); }
		for (int i = 0; i < io3Pool.length; i++) { try { io3Pool[i].join(); } catch (InterruptedException nx) { nx.printStackTrace(); } }

		if(getHour.equals("00") || getHour.equals("06") || getHour.equals("12") || getHour.equals("18")) {

			final File wwwOutImages4 = new File(wwwOutBase+"/MergedJ/Images4");
			final File memGFS = new File(xml2Path.getPath()+"/tmpic/GFS");
			final File memNAM = new File(xml2Path.getPath()+"/tmpic/NAM");
			final File memHRWA = new File(xml2Path.getPath()+"/tmpic/HRWA");
			final File memHRWN = new File(xml2Path.getPath()+"/tmpic/HRWN");
			final File namMP4 = new File(xml2Path.getPath()+"/NAM_Loop.mp4");
			final File gfsMP4 = new File(xml2Path.getPath()+"/GFS_Loop.mp4");
			final File hrwaMP4 = new File(xml2Path.getPath()+"/HRWA_Loop.mp4");
			final File hrwnMP4 = new File(xml2Path.getPath()+"/HRWN_Loop.mp4");

			memGFS.mkdirs();
			memNAM.mkdirs();
			memHRWA.mkdirs();
			memHRWN.mkdirs();
			wwwOutImages4.mkdirs();
			
			gfsMP4.delete();
			namMP4.delete();
			hrwaMP4.delete();
			hrwnMP4.delete();

			Thread io4a = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+xml2Path.getPath()+"/*NAM_* "+memNAM.getPath()); }});
			Thread io4b = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+xml2Path.getPath()+"/*GFS_* "+memGFS.getPath()); }});
			Thread io4c = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+xml2Path.getPath()+"/*HRWA_* "+memHRWA.getPath()); }});
			Thread io4d = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+xml2Path.getPath()+"/*HRWN_* "+memHRWN.getPath()); }});
			Thread io4Pool[] = { io4a, io4b, io4c, io4d }; 
			for (Thread thread : io4Pool) { thread.start(); }
			for (int i = 0; i < io4Pool.length; i++) { try { io4Pool[i].join(); } catch (InterruptedException nx) { nx.printStackTrace(); } }

			StumpJunk.runProcess("rm "+wwwOutImages4.getPath()+"/*.png");

			Thread io5a = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+memNAM.getPath()+"/*.png "+wwwOutImages4.getPath()); }});
			Thread io5b = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+memGFS.getPath()+"/*.png "+wwwOutImages4.getPath()); }});
			Thread io5c = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+memHRWA.getPath()+"/*.png "+wwwOutImages4.getPath()); }});
			Thread io5d = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("cp "+memHRWN.getPath()+"/*.png "+wwwOutImages4.getPath()); }});
			Thread io5Pool[] = { io5a, io5b, io5c, io5d }; 
			for (Thread thread : io5Pool) { thread.start(); }
			for (int i = 0; i < io5Pool.length; i++) { try { io5Pool[i].join(); } catch (InterruptedException nx) { nx.printStackTrace(); } }

			StumpJunk.runProcess("mogrify -format png -gravity center -crop "+stdRes+"+0+0 "+wwwOutImages4.getPath()+"/*.png");

			Thread io6a = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("bash "+helpers.getPath()+"/Sequence.sh "+memNAM.getPath()+" png"); }});
			Thread io6b = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("bash "+helpers.getPath()+"/Sequence.sh "+memGFS.getPath()+" png"); }});
			Thread io6c = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("bash "+helpers.getPath()+"/Sequence.sh "+memHRWA.getPath()+" png"); }});
			Thread io6d = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("bash "+helpers.getPath()+"/Sequence.sh "+memHRWN.getPath()+" png"); }});
			Thread io6Pool[] = { io6a, io6b, io6c, io6d }; 
			for (Thread thread : io6Pool) { thread.start(); }
			for (int i = 0; i < io6Pool.length; i++) { try { io6Pool[i].join(); } catch (InterruptedException nx) { nx.printStackTrace(); } }

			Thread io7a = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("ffmpeg -threads 8 -r 10 -i "+memNAM.getPath()+"/%05d.png -vcodec libx264 -pix_fmt yuv420p "+namMP4.getPath()); }});
			Thread io7b = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("ffmpeg -threads 8 -r 10 -i "+memGFS.getPath()+"/%05d.png -vcodec libx264 -pix_fmt yuv420p "+gfsMP4.getPath()); }});
			Thread io7c = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("ffmpeg -threads 8 -r 10 -i "+memHRWA.getPath()+"/%05d.png -vcodec libx264 -pix_fmt yuv420p "+hrwaMP4.getPath()); }});
			Thread io7d = new Thread(new Runnable() { public void run() { StumpJunk.runProcess("ffmpeg -threads 8 -r 10 -i "+memHRWN.getPath()+"/%05d.png -vcodec libx264 -pix_fmt yuv420p "+hrwnMP4.getPath()); }});
			Thread io7Pool[] = { io7a, io7b, io7c, io7d }; 
			for (Thread thread : io7Pool) { thread.start(); }
			for (int i = 0; i < io7Pool.length; i++) { try { io7Pool[i].join(); } catch (InterruptedException nx) { nx.printStackTrace(); } }

			if(getHour.equals("00") || getHour.equals("12")) {

				final File memCMC = new File(xml2Path.getPath()+"/tmpic/CMC");	
				final File cmcMP4 = new File(xml2Path.getPath()+"/CMC_Loop.mp4");

				memCMC.mkdirs();
				cmcMP4.delete();

				StumpJunk.runProcess("cp "+xml2Path.getPath()+"/*CMC_* "+memCMC.getPath());
				StumpJunk.runProcess("bash "+helpers.getPath()+"/Sequence.sh "+memCMC.getPath()+" png");
				StumpJunk.runProcess("ffmpeg -threads 8 -r 10 -i "+memCMC.getPath()+"/%05d.png -vcodec libx264 -pix_fmt yuv420p "+cmcMP4.getPath());

			}


		}

		StumpJunk.runProcess("rm "+wwwOutLoops.getPath()+"/*");
		StumpJunk.runProcess("rm "+xml2Path.getPath()+"/*.png");
		StumpJunk.runProcess("cp "+xml2Path.getPath()+"/*.mp4 "+wwwOutLoops.getPath());
		StumpJunk.runProcess("zip -9rv "+wwwOutArchive.getPath()+"/"+modelRunString+".zip "+wwwOutLoops.getPath()+"/*.mp4");
		StumpJunk.runProcess("chown www-data "+wwwOutArchive.getPath()+"/"+modelRunString+".zip");
		StumpJunk.runProcess("(ls "+wwwOutArchive.getPath()+"/*.zip -t | head -n 12; ls "+wwwOutArchive.getPath()+"/*.zip)|sort|uniq -u|xargs rm");

	}

}
