[10/26/2011 9:53:18 PM] *** Keith Webb added Trey Brister ***
[10/26/2011 9:53:50 PM] Keith Webb: ok, I added you to the conversation
[10/26/2011 9:56:06 PM] Keith Webb: Maros, do you need to see the backend/databases/etc or is the pdf enough?
[10/26/2011 9:56:19 PM] Trey Brister: Hi maros
[10/26/2011 9:56:54 PM] Mark Fric: Hello
[10/26/2011 9:57:17 PM] Keith Webb: We've been very impressed with your previous work
[10/26/2011 9:58:44 PM] Trey Brister: Its a famous software
[10/26/2011 9:59:00 PM] Mark Fric: yes, thanks. 
well, let mesay first that I haven't worked with CodeIgniter before. I know other framewerks, and it is not a big problem to work in another framework, but the deadline is very though
[10/26/2011 9:59:44 PM] Trey Brister: there is a learning curve but you dont have to write sql and you dont have to concatenate html in the php with codeigniter
[10/26/2011 9:59:55 PM] Trey Brister: and there are shortcuts for everything
[10/26/2011 9:59:57 PM] Keith Webb: we've got 4 full time programmers on our end and a lot of it is done
[10/26/2011 10:00:55 PM] Trey Brister: http://mymallcoupons.com/myaccount/
guest
password
[10/26/2011 10:01:10 PM] Keith Webb: the deadline is for a company that has an exclusive with Wal-Mart and they want to use it for the holiday season
[10/26/2011 10:01:49 PM] Trey Brister: i think its great to integrate post affiliate pro into a codeigniter library so we dont have to roll our own
[10/26/2011 10:01:51 PM] Keith Webb: A Database Error Occurred

Error Number: 1054

Unknown column 'loc_users.id' in 'where clause'

SELECT `loc_users`.* FROM (`loc_users`) WHERE `loc_users`.`id` = '3'

Filename: /home/mymall/public_html/models/ion_auth_model.php

Line Number: 1031
[10/26/2011 10:02:07 PM] Trey Brister: what url?
[10/26/2011 10:02:14 PM] Keith Webb: the one you sent
[10/26/2011 10:02:23 PM] Trey Brister: field is user_id not id
[10/26/2011 10:02:39 PM] Keith Webb: worked that time
[10/26/2011 10:02:47 PM] Trey Brister: thats probably old
[10/26/2011 10:02:55 PM] Trey Brister: i just registered and logged in
[10/26/2011 10:02:56 PM] Trey Brister: no error
[10/26/2011 10:03:12 PM] Mark Fric: I also logged in without any problem
[10/26/2011 10:03:23 PM] Keith Webb: well, there you go...it's just me...hehehe
[10/26/2011 10:03:37 PM] Mark Fric: but what is this? a superadmin panel for the site?
[10/26/2011 10:03:50 PM] Trey Brister: one user has multiple user_infos because each listing or coupon can have different user information for each of their resources
[10/26/2011 10:04:06 PM] Trey Brister: you can set one of the user infos as default for the user
[10/26/2011 10:04:13 PM] Trey Brister: also you can create child users
[10/26/2011 10:04:21 PM] Trey Brister: that is the humble beginning
[10/26/2011 10:04:36 PM] Trey Brister: it uses ion_auth for authentication
[10/26/2011 10:04:40 PM] Trey Brister: on our tables
[10/26/2011 10:04:51 PM] Trey Brister: [Wednesday, October 26, 2011 10:01 PM] Trey Brister: 

<<< i think its great to integrate post affiliate pro into a codeigniter library so we dont have to roll our own
[10/26/2011 10:05:49 PM] Mark Fric: guys, I'm lost here. I don't know your softwareyet, and I don't know what's done and what has to be done. 
do you need my help only to integrate post affiliate pro into code igniter library?
[10/26/2011 10:06:00 PM] Trey Brister: no not just that
[10/26/2011 10:06:06 PM] Trey Brister: it was just thinking out loud
[10/26/2011 10:06:19 PM] Trey Brister: i dont know if its possible or not
[10/26/2011 10:06:33 PM] Keith Webb: No, we need programmers to link the database to the html
[10/26/2011 10:06:37 PM] Trey Brister: yes
[10/26/2011 10:07:12 PM] Trey Brister: so far we connected the user system without one single line of sql

everything in activerecord
[10/26/2011 10:07:44 PM] Trey Brister: like $this->db->get();
[10/26/2011 10:07:46 PM] Trey Brister: etc.
[10/26/2011 10:08:15 PM] Trey Brister: and no html mixed with the php except in views
[10/26/2011 10:08:29 PM] Keith Webb: Trey, just spell out what needs to be done and let him ask the questions, please
[10/26/2011 10:08:36 PM] Mark Fric: yes please
[10/26/2011 10:08:38 PM] Trey Brister: OK
[10/26/2011 10:09:11 PM] Trey Brister: First priority is to duplicate existing functionality and add reporting / logging as described in the doc.
[10/26/2011 10:09:28 PM] Trey Brister: I guess add listing, category, location
[10/26/2011 10:09:45 PM] Trey Brister: Affiliate Partners (maybe post affiliate pro)
[10/26/2011 10:09:56 PM] Trey Brister: Plans
[10/26/2011 10:10:06 PM] Trey Brister: Plans assigned to limits in the limits table
[10/26/2011 10:10:31 PM] Trey Brister: use codeigniter-payments library from http://getsparks.org
[10/26/2011 10:10:42 PM] Trey Brister: and add bluepay as a payment method to that
[10/26/2011 10:11:10 PM] Trey Brister: sms integration with trumpia.  we have working code for that on the old site
[10/26/2011 10:11:35 PM] Trey Brister: just the existing functionality of http://localbargains.mobi and http://localbargains.mobi/siteadmin
[10/26/2011 10:11:51 PM] Keith Webb: damn...is that all?  hehehe
[10/26/2011 10:11:56 PM] Trey Brister: user admin
pass localbargains123
[10/26/2011 10:12:11 PM] Trey Brister: that is a minimally viable product not taking new features into account
[10/26/2011 10:12:24 PM] Trey Brister: and the reporting
[10/26/2011 10:13:02 PM] Trey Brister: I made a database.  Manas it working with it.  It has a lot of join tables to enable flexibility for future changes.
[10/26/2011 10:13:43 PM] Trey Brister: I know premature optimization is the root of all evil and if you can find tables you think you dont know why they are there I can explain every field
[10/26/2011 10:14:01 PM] Keith Webb: Trey, just stop and let him take in what you just wrote
[10/26/2011 10:14:05 PM] Trey Brister: ok hanks
[10/26/2011 10:14:07 PM] Trey Brister: thanks
[10/26/2011 10:14:54 PM] Trey Brister: brb 2 minutes please
[10/26/2011 10:15:18 PM] Keith Webb: maros, is your brain hurting yet?   hehehe
[10/26/2011 10:15:54 PM] Mark Fric: :) I'm looking at the siteadmin now
[10/26/2011 10:16:46 PM] Keith Webb: k, take your time...we want your honest opinion on where we stand, what it would take to complete it and if you can help out
[10/26/2011 10:18:07 PM] Mark Fric: the surrent status now is that you have HTML and database, but no real php code in the new version?
[10/26/2011 10:18:36 PM] Keith Webb: yes, that's why we need additional programmers
[10/26/2011 10:19:35 PM] Mark Fric: and yorur current programmers will work on that as well?
[10/26/2011 10:19:43 PM] Keith Webb: yes
[10/26/2011 10:19:53 PM] Trey Brister: im back
[10/26/2011 10:19:58 PM] Keith Webb: 4 all together
[10/26/2011 10:20:01 PM] Trey Brister: one model
[10/26/2011 10:20:07 PM] Trey Brister: two controllers
[10/26/2011 10:20:12 PM] Trey Brister: couple of views
[10/26/2011 10:20:17 PM] Trey Brister: are already done
[10/26/2011 10:20:41 PM] Trey Brister: sabuj is working on add listing
[10/26/2011 10:20:50 PM] Keith Webb: trey...let us talk
[10/26/2011 10:20:53 PM] Trey Brister: ok
[10/26/2011 10:22:40 PM] Mark Fric: ok. well, honestly, I'm not sure I can help. it is just 20 days until deadline, and it would take me some time to understand the application and framework
[10/26/2011 10:26:45 PM] Keith Webb: would you be willing to try?
[10/26/2011 10:27:24 PM] Keith Webb: I think someone like you (that is familiar with this field) would be able to give us great insight
[10/26/2011 10:28:14 PM] Mark Fric: it is hard for me to estimate the task, because i haven't worked with CodeIgniter before. 
Maybe I can work on some part that is clearly defined, like siteadmin - I assume it is just a copy of old functionality to the new system

But I would need to try making some simpler task first
[10/26/2011 10:29:01 PM] Keith Webb: Trey...is there a reason we chose codeignitor as opposed to asp?
[10/26/2011 10:29:08 PM] Trey Brister: yes
[10/26/2011 10:29:13 PM] Keith Webb: k
[10/26/2011 10:29:22 PM] Trey Brister: asp wont work on your server
[10/26/2011 10:29:28 PM] Trey Brister: you will have to use windows server
[10/26/2011 10:29:31 PM] Mark Fric: there's no problem with codeigniter, it is a good framework
[10/26/2011 10:29:38 PM] Trey Brister: windows server only provides ftp access
[10/26/2011 10:29:41 PM] Trey Brister: not shell access
[10/26/2011 10:30:10 PM] Keith Webb: I was just checking...is there something we could give Maros to start with to let him see if he can help?
[10/26/2011 10:30:42 PM] Trey Brister: i would appreciate it if we dont need to create a new wheel if he has post affiliate pro already written
[10/26/2011 10:31:03 PM] Trey Brister: if it will be flexible enough to meet your requirements
[10/26/2011 10:31:12 PM] Trey Brister: i dont have experience
[10/26/2011 10:31:14 PM] Trey Brister: with it
[10/26/2011 10:31:34 PM] Keith Webb: so...what you're saying is try to see if it will work with this since he's familar with it
[10/26/2011 10:31:43 PM] Mark Fric: ok, but I haven't worked with it for a couple of years already. i'm not sure what exactly you need from it, but it has API, it should be flexible enough
[10/26/2011 10:32:04 PM] Trey Brister: 2 tier affiliate
[10/26/2011 10:32:16 PM] Trey Brister: choice or percent, flat rate and click
[10/26/2011 10:32:22 PM] Trey Brister: keith
[10/26/2011 10:32:39 PM] Trey Brister: do other people that buy a location get to use the affiliate program?
[10/26/2011 10:32:41 PM] Trey Brister: or just you
[10/26/2011 10:32:42 PM] Keith Webb: yes
[10/26/2011 10:32:47 PM] Trey Brister: i think that will be the limitation
[10/26/2011 10:33:23 PM] Trey Brister: i think post affiliate pro is single admin
[10/26/2011 10:33:25 PM] Trey Brister: i am not sure
[10/26/2011 10:33:40 PM] Trey Brister: i dont know if we can use it for each of the admins seperately
[10/26/2011 10:33:56 PM] Mark Fric: there are multiple admins, but they haveaccess to everycampaign. do you need to create campaigns per admin?
[10/26/2011 10:34:06 PM] Trey Brister: yes
[10/26/2011 10:34:15 PM] Trey Brister: they would only see their own
[10/26/2011 10:34:28 PM] Trey Brister: campaigns
[10/26/2011 10:34:33 PM] Trey Brister: and their own affiliates
[10/26/2011 10:34:47 PM] Trey Brister: and make payments from seperate paypal
[10/26/2011 10:36:04 PM] Mark Fric: there's PAP Network edition, I think it does what you need - it allows running independent affiliate programs for every admin. But it is quite expensive and also more complicated.
I haven't worked with Network edition yet
[10/26/2011 10:36:16 PM] Trey Brister: ok i see
[10/26/2011 10:36:42 PM] Mark Fric: maybe it would be simpler to make your own simple affiliate program
[10/26/2011 10:36:48 PM] Trey Brister: i think you are right
[10/26/2011 10:37:28 PM] Trey Brister: because i think that it will require seperate registraton in PAP and localbargains
[10/26/2011 10:37:59 PM] Trey Brister: we have one now it track clicks only not payments yet
[10/26/2011 10:38:02 PM] Mark Fric: yes, or synchronizing users, which might be quite complicated
[10/26/2011 10:40:13 PM] Keith Webb: So Maros, what would you feel comfortable with to start out...just to see if you could work with us
[10/26/2011 10:42:10 PM] Mark Fric: i think the best would be some part of siteadmin, for example advertisers
[10/26/2011 10:42:44 PM] Trey Brister: i need to get time when you are free and can help you setup your computer so you can clone
[10/26/2011 10:42:49 PM] Trey Brister: clone to localhost
[10/26/2011 10:43:13 PM] Trey Brister: do you wamp or xampp?
[10/26/2011 10:43:15 PM] Trey Brister: or linux
[10/26/2011 10:43:38 PM] Mark Fric: is it very difficult? I can install the project and set up mysql database if you'll give me the dump

wamp
[10/26/2011 10:43:45 PM] Trey Brister: cd \wamp\www
[10/26/2011 10:44:12 PM] Trey Brister: hg clone http://mymallcoupons.com:9000 mymall
hg clone http://mymallcoupons.com:9001 localbar
[10/26/2011 10:44:15 PM] Trey Brister: mymall is new site
[10/26/2011 10:44:20 PM] Trey Brister: localbar is old site
[10/26/2011 10:44:27 PM] Trey Brister: sql is in the directory
[10/26/2011 10:45:28 PM] Trey Brister: are you on x86 windows or 64 bit
[10/26/2011 10:45:40 PM] Mark Fric: 64bit
[10/26/2011 10:45:58 PM] Trey Brister: http://mercurial.selenic.com/downloads
[10/26/2011 10:46:36 PM] Trey Brister: direct download for mercurial
[10/26/2011 10:47:29 PM] Trey Brister: use myaccount.php for example of good clean codeigniter code.   manas wrote that
[10/26/2011 10:47:48 PM] Trey Brister: it joins many tables so i think you can get good example from it
[10/26/2011 10:48:22 PM] Mark Fric: ok. i'm downloading the code now, I'll look at it and try to do something
[10/26/2011 10:48:28 PM] Trey Brister: thanks
[10/26/2011 10:49:31 PM] Trey Brister: please make a file mymall.bat and place in c:\windows
with this text
c:
cd \wamp\www\mymall
hg incoming
hg pull -u
hg merge
hg status
[10/26/2011 10:49:42 PM] Trey Brister: then when you need to pull just type mymall
[10/26/2011 10:50:02 PM] Mark Fric: ok. I'll work on that tomorrow (it's night here now) and I'll let you know
[10/26/2011 10:50:17 PM] Trey Brister: please ask me a lot of questions I am here for you
[10/26/2011 10:50:25 PM] Trey Brister: I will be your resource
[10/26/2011 10:50:39 PM] Keith Webb: Thanks Maros
[10/26/2011 10:50:48 PM] Trey Brister: Thanks, Really :)
[10/26/2011 10:50:52 PM] Mark Fric: ok. where exactly is the databasecreate script?
[10/26/2011 10:51:00 PM] Trey Brister: mymall.sql
[10/26/2011 10:51:13 PM] Trey Brister: import as query in phpmyadmin or command line
[10/26/2011 10:51:22 PM] Trey Brister: or browse and import
[10/26/2011 10:51:30 PM] Mark Fric: ok, i didn't see it
[10/26/2011 10:51:36 PM] Trey Brister: thanks
[10/26/2011 10:51:51 PM] Trey Brister: its subject to change i will make sure updated sql is in the pull
[10/26/2011 10:52:11 PM] Trey Brister: you need a blank database.php from codeigniter filled in your server values
[10/26/2011 10:52:27 PM] Mark Fric: sure
[10/26/2011 10:52:30 PM] Trey Brister: for security application/config/database.php is not in the push
[10/26/2011 10:53:21 PM] Mark Fric: ok. as I said, I'll look at it tomorow, and I'll be smarter in the evening. we can chat again at this time
[10/26/2011 10:53:35 PM] Trey Brister: i am on your schedule call me whenever you need me
[10/26/2011 10:53:44 PM] Mark Fric: ok, good
[10/26/2011 10:53:47 PM] Trey Brister: thanks
[10/26/2011 10:53:54 PM] Mark Fric: no problem
[10/26/2011 10:54:34 PM] Mark Fric: so let's talk tomorow. see you
[10/26/2011 10:54:38 PM] Trey Brister: see you
[10/26/2011 10:54:55 PM] Keith Webb: bye..thanks
[10/27/2011 4:23:49 AM] *** Keith Webb removed Trey Brister from this conversation. ***
