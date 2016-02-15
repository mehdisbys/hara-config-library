(CI badges)

# HARA XXXXXX Service

[statement of what the service is for]

When you have created a new repository for your service do the following : 

1. Add this repository to your origin : `git remote add template git@github.com:JSainsburyPLC/hara-be-service-template.git`
2. `git pull template master`
3. `git remote rm template`
4. Replace all the config-library with the name you've decided - e.g. MyService
5. Check it's all good
6. `git push origin master`



Tip: To remove the from the files XXXXXX use the following command

``perl -p -i -e 's/ConfigLibrary/MyService/g' `grep -Rl --exclude-dir=.git 'ConfigLibrary' . ` ``

``perl -p -i -e 's/config-library/myService/g' `grep -Rl --exclude-dir=.git 'config-library' . ` ``

<sub>*(second one is for all lowercase instances...)</sub>

Don't forget to *change manually the directories* named Xxxxx - or you can try

``for d in $( find . -name ConfigLibrary ) ; do mv $d `echo $d | sed 's/Xx*$/MyService/g' ` ; done ``
