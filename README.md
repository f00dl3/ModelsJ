# ModelsJ
Java Model Data Processor

Production
2017-10-19

Changes:
 - Small bug fix to Models.java
 
Still working on:

 - Fixing any remaining bugs.
 - (Maybe?) Java JNI for FFMPEG/ImageMagick

You will need to create mappings in SQL to help this along based on what/how much data you want. Sample table structure included. Sample PHP files included.

A fast Internet connection is required. And unlimited data. Be warned. This "program" is easily capable of processing 3-5 TB/month of data. Without the 2 High-resolution western US computer models using Bash scripting, it already eats 2-3 TB/month.

MyDBConnector = simple MySQL database connector. You can find examples using Google.

wgrib2, g2ctl, gribmap, get_grib.pl, get_inv.pl, grads - can all be found through Google as well. I do not own the code, so I am not including it.

You pretty much must have a bleeding edge system - AT LEAST 32 GB of RAM and a Core i7 4790k (8x4GHz) or better is recommended. I upgraded to 32 GB because of my "older" Bash iteration of this. AT LEAST 300 Megabit Internet, and unlimited data with NO CAP is a must as - again - this can use 5 TB per month! Even with that, it can peg your CPU at 100% for 30-40 minutes 4 times per day with load indexes 25-35. (Note since most of this is done in /dev/shm, it's not IO wait, so hardly noticable from a usability perspective.)

* Somewhere down the road I may make use of the nVidia CUDA Java Libraries.
