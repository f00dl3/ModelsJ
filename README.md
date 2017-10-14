# ModelsJ
Java Model Data Processor

PREVIEW - Not all functionally fully working yet!

Still working on:

 - Fixing bugs in GRIB2 processing.
 - Image operations / MP4 loop creator (ModelImageOps.java)
 - Worker controller (ModelWorker.java)
 - Main controller (Models.java)

SQL table design not included. You will need to create mappings in SQL to help this along based on what/how much data you want.
A fast Internet connection is required. And unlimited data. Be warned. This "program" is easily capable of processing 3-5 TB/month of data. Without the 2 High-resolution western US computer models using Bash scripting, it already eats 2-3 TB/month.

MyDBConnector = simple MySQL database connector. You can find examples using Google.
