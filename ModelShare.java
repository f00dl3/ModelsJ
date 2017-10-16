package jASUtils;

import java.io.*;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

import jASUtils.MyDBConnector;
import jASUtils.StumpJunk;

public class ModelShare {	
	
	final static File ramDrive = StumpJunk.ramDrive;
	final static File appPath = new File("/usr/local/bin");
	final static File xml2Path = new File(ramDrive.getPath()+"/modelsJ");
	final static File imgOutPath = new File(xml2Path.getPath()+"/tmpic");
	final static File helpers = StumpJunk.helpers;
	final static File pointDump = new File(xml2Path.getPath()+"/pointDump.txt");
	
	public static double windDirCalc(double tWUin, double tWVin) { return 57.29578*(Math.atan2(tWUin, tWVin))+180; }
	public static double windSpdCalc(double tWUin, double tWVin) { return Math.sqrt(tWUin*tWUin+tWVin*tWVin)*1.944; }
	public static double calcSLCL(double tTCin, double tRHin) { return (20+(tTCin/5))*(100-tRHin); }
	public static double calcDwpt(double tTCin, double tRHin) { return tTCin-(100-tRHin)/5; }

	public static String pointInputAsString(String tStation) {
		final String pointsSQL = "SELECT SUBSTRING(Point, 2, CHAR_LENGTH(Point)-2) AS Coords FROM WxObs.Stations WHERE Station='"+tStation+"' ORDER BY Station DESC;";
		List<String> pointInputArray = new ArrayList<String>();
		try (
			Connection conn = MyDBConnector.getMyConnection(); Statement stmt = conn.createStatement();
			ResultSet resultSetPIA = stmt.executeQuery(pointsSQL);
		) { while (resultSetPIA.next()) { pointInputArray.add(resultSetPIA.getString("Coords")); } }
		catch (Exception e) { e.printStackTrace(); }
		String thisGeo = null;
		String pointInputString = "";
		for (String point : pointInputArray) {
			thisGeo = point.replace(",", " ");
			pointInputString += "-lon "+thisGeo+" ";
		}
		return pointInputString;
	}

	public static String filters(String whichOne) {
		
		File filtFile = null;
		String filtData = null;
		Scanner filtScanner = null;

		switch(whichOne) { 
		
			case "g2f": 
				filtFile = new File(helpers.getPath()+"/g2Filters.txt");
				try { filtScanner = new Scanner(filtFile); while(filtScanner.hasNext()) { filtData = filtScanner.nextLine(); } }
				catch (FileNotFoundException fnf) { fnf.printStackTrace(); }
				break;
		
			case "g2fd": 
				filtFile = new File(helpers.getPath()+"/g2FiltersD.txt");
				filtScanner = null; try { filtScanner = new Scanner(filtFile); while(filtScanner.hasNext()) { filtData = filtScanner.nextLine(); } }
				catch (FileNotFoundException fnf) { fnf.printStackTrace(); }
				break;
		
			case "g2fr": 
				filtFile = new File(helpers.getPath()+"/g2FiltersR.txt");
				filtScanner = null; try { filtScanner = new Scanner(filtFile); while(filtScanner.hasNext()) { filtData = filtScanner.nextLine(); } }
				catch (FileNotFoundException fnf) { fnf.printStackTrace(); }
				break;

		}

		return filtData;

	}

	public static String jsonMerge(String modelName) {
		String thisJSON = null;
		try { thisJSON = StumpJunk.runProcessOutVar("cat "+xml2Path.getPath()+"/"+modelName+"Out*.json"); } catch (IOException ix) { ix.printStackTrace(); }
		thisJSON = ("{"+thisJSON+"}").replace("\n","").replace(",}", "}").replace("{,","");
		return thisJSON;
	}
		
}
