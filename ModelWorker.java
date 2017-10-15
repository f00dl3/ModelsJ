package jASUtils;

import java.io.*;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

import org.joda.time.DateTime;
import org.joda.time.DateTimeZone;
import org.joda.time.format.DateTimeFormat;
import org.joda.time.format.DateTimeFormatter;
import org.json.*;

import jASUtils.MyDBConnector;
import jASUtils.StumpJunk;
import jASUtils.ModelShare;
import jASUtils.ModelWorkerCMC;
import jASUtils.ModelWorkerGFS;
import jASUtils.ModelWorkerHRRR;
import jASUtils.ModelWorkerHRWA;
import jASUtils.ModelWorkerHRWN;
import jASUtils.ModelWorkerNAM;

public class ModelWorker {
	
	public static void main(String args[]) {
		
		final File ramDrive = ModelShare.ramDrive;
		final String getHour = args[0];
		final String round = args[1];
		final DateTime tDateTime = new DateTime(DateTimeZone.UTC).minusHours(4);
		final DateTimeFormatter getDateFormat = DateTimeFormat.forPattern("yyyyMMdd");
		final String getDate = getDateFormat.print(tDateTime);
		final String modelRunString = getDate+"_"+getHour+"Z";
		final File appPath = new File("/usr/local/bin");
		final File xml2Path = new File(ramDrive+"/modelsJ");
		final File helpers = new File("/dev/shm/jASUtils/helpers");
		boolean int6h = false;
		boolean int12h = false;
	
		if(getHour.equals("00") || getHour.equals("06") || getHour.equals("12") || getHour.equals("18")) { int6h = true; }
		if(getHour.equals("00") || getHour.equals("12")) { int12h = true; }

		final String[] hrrrArgs = { getHour, round }; ModelWorkerHRRR.main(hrrrArgs);
		
		if(int6h) {
			
			final String[] gfsArgs = { getHour, round }; ModelWorkerGFS.main(gfsArgs);
			final String[] namArgs = { getHour, round }; ModelWorkerNAM.main(namArgs);
			final String[] hrwaArgs = { getHour, round }; ModelWorkerHRWA.main(hrwaArgs);
			final String[] hrwnArgs = { getHour, round }; ModelWorkerHRWN.main(hrwnArgs);
			
			if(int12h) {
				final String[] cmcArgs = { getHour, round }; ModelWorkerCMC.main(cmcArgs);
			}
			
			
		}
		
	}
	
}
