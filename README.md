BiterTweet-PHP
==============

An application for working with twitter API.<br/>
This app is developing on Django so it's published for working more on PHP version. <br/>
With BiterTweet you can read tweets,post new tweet and favorite a tweet.

## Libraries ##

In this very old project I used this libraries:

- Smarty template engine [http://www.smarty.net]
- Reabean php framework [http://www.redbeanphp.com/]
- twitter-async oAuth library [https://github.com/jmathai/twitter-async]
- Very old Bootstrap css framework

## Installing ##

- The first tip <br/>
You must develop this application on web server.because twitter api just replay to server requests not local.

- Database <br/>
For database,there is no installaion file unfortunately.so you must import database.sql from database folder.
Database setting can be set in /controls/conf.php

- Twitter API settings <br/>
For setting your costumer key and secret key,you must set these in /oAuth/1/lib/secret.php
In twitter dev center,set your callback url to /oAuth/1/bt_oAuth.php

## API ##
There is some features for using app API.all codes exists in /api folder as well.you can easily create apps in other platforms.
there is Bitertweet android and java app and it is possible these will be published in future.


#Contributing
Start developing and send pull request.


#License

Licensed under the Apache License, Version 2.0 [http://www.apache.org/licenses/LICENSE-2.0.html]

