(CI badges)

# HARA XXXXXX Service

[statement of what the service is for]

When you have created a new repository for your service do the following : 

1. Add this repository to your origin : `git remote add template git@github.com:JSainsburyPLC/hara-be-service-template.git`
2. `git pull template master`
3. `git remote rm template`
4. Replace all the xxxxxx with the name you've decided - MyService
5. Check it's all good
6. `git push origin master`



Tip: To remove the from the files XXXXXX use the following command

``perl -p -i -e 's/Xxxxxx/MyService/gi' `grep -Rli --exclude-dir=./.git 'Xxxxxx' . ` ``

Don't forget to *change manually the directories* named Xxxxx
