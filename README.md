# GCPan
######20180105

该版本是GCPan的开发版，非上线版
.git 不包括：
`
	/blat

	/ul_files

	/dl_files

	/img
	
	/pic
`

BlackDomain上配置多个key，测试方法：

	ssh -T git@github.com
	
	ssh -T git@github-cgm-gcpan
	
	reference:https://www.jianshu.com/p/12badb7e6c10


提交git可参照下列命令：

1.从头提交
```
	git init
	git pull git@github-cgm-gcpan:SJTU-CGM/GCPan.git
	git remote add cgm-origin git@github-cgm-gcpan:SJTU-CGM/GCPan.git
	git add newFile
	git commit -m "message"
	git push -u cgm-origin master
```
2.当前位置提交
/share/home/yyqiao/project/SJTU-CGM/GCPan
```
git pull git@github-cgm-gcpan:SJTU-CGM/GCPan.git
git add newFile
git commit -m "message"
git push

```
