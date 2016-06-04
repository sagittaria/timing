在 test-pull-request这个branch里再加一行
试试 pull request 怎么用

Some conventions: 1.Caaa - aaa controller, Mbbb - bbb model, MFccc - ccc model function; 2. /view/vddd - ddd controller's views.
约定：1.控制器以大写的C开头，模型以大写的M开头，模型的方法以大写的MF开头（一般控制器的方法就是普通的动词或词组，从第二个词开始首字母大写）
2.视图文件夹以小写v开头，/view/vddd 放的是 ddd 控制器的视图文件。

I am using CodeIgniter-3.0.4 to develop a tiny web application, named with "timing", which is designed to record(or memorize?) how I spend my time.
我在用 CI-3.0.4 做一个记录时间消费的web应用，名字叫做 timing.

MySQL5.6 and PHP5.5 are chosen to do this work.
使用的是 MySQL5.6 + PHP5.5

I only track 4 folders, [.../public](js+css), [.../application/controllers], [.../application/models] and [.../application/views], and a DDL script(for creating the db tables). If you want to deploy this app in your own server, please configure the database connection first. Btw, my db driver is PDO.
我只跟踪4个文件夹：public(放css+js)、application目录下的controllers，models，views和另一个数据库脚本 Script.sql。如果你想用，需要自己配置数据库连接（我用的是PDO）

this is a repo for storing source code of a web app called [timing]. -2016.05.02
这是个放timing程序源代码的库
