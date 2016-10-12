--------------------
Extra: countTrackula
--------------------
Version: 1.0.1

Author: demon.devin <demon.devin@gmail.com>
Copyright 2016

Official Documentation: http://portableappz.cu.cc/extras/countTrackula

Bugs and Feature Requests: https://github.com:demondevin/countTrackula

Questions: http://forums.modx.com

--------------------
How to use
--------------------

 With this snippet you will have the ability to display the number of downloads both unique or total.

 PROPERTIES
 &path       string   required    path to the file to download with trailing slash
 &file       string   required    filename of the download without any slashes
 &name       string   optional    the title of the link you want to show | defaults to &file
 &hits       boolean  optional    just shows the download count of &file | defaults to false
 &resume     boolean  optional    specify support for resumable download | defaults to false
 &showhits   boolean  optional    shows the hit count on a download link | defaults to false

 EXAMPLE 
 Give a file with a &path of `downloads/` and a &file name of `MyPackage.zip` 
 With the &name of `My Package` and supports resume download while showing the hit count.

 [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &name=`My Package` &resume=`true` &showhits=`true`]]

 Output: My Package (# hits)
 Output pagesource: <a href="REQUEST_URI?download=FILENAMEmd5HASH">My Package</a> (# hits)
 
 To just show the number of times &file has been downloaded.  # = the actual number
 
 [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &hits=`true`]]
 
 Output: #
 Output pagesource: #