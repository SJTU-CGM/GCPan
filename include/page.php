<?php
class page{
    private $dbadd; //数据库地址
    private $dbuser; //数据库用户名
    private $dbpwd; //数据库密码
    private $dbname; //数据库名
    private $tablename; //数据表名
    private $num; //每页显示的行数
    private $total; //表中数据总数
    private $totalpage; //总页数
    private $page; //当前页数
    private $limit; //查询数
    private $arrs; //查询后返回的数据
    private $col; //总列数
    private $nostart; //当前页开始的记录数
    private $noend; //当前页结束的记录数
    private $head; //首页
    private $end;  //尾页
    private $last;  //上一页
    private $nexts;  //下一页
 
    function __construct($dbadd, $dbuser, $dbpwd, $dbname, $tablename, $num){
        $this->dbadd=$dbadd;
        $this->dbuser=$dbuser;
        $this->dbpwd=$dbpwd;
        $this->dbname=$dbname;
        $this->tablename=$tablename;
        $this->num=$num;
        $this->total=$this->gettotal();   //得到总条数
        $this->totalpage=ceil($this->total/$this->num); //获取总页数
        $this->page=$this->getpage(); //得到当前页数
        $this->limit=$this->setlimit(); //得到查询的数据
        $this->arrs=$this->getarrs(); //得到查询的结果      
        $this->col=$this->getcol(); //获取总列数
        $this->nostart=($this->page-1)*$num+1;
        $this->noend=$this->page==$this->totalpage ? $this->total : $this->page*$num;
        $this->head=$this->page==1 ? "首页" : "<a href='?page=1'>首页</a>";
        $this->end=$this->page==$this->totalpage ? "尾页" : "<a href='?page={$this->totalpage}'>尾页</a>";
        $this->last=$this->page==1 ? "上一页" : "<a href='?page=".($this->page-1)."'>上一页</a>";
        $this->nexts=$this->page==$this->totalpage ? "下一页" : "<a href='?page=".($this->page+1)."'>下一页</a>";
    }
 
    private function getcol(){
        $linkss=mysql_connect($this->dbadd, $this->dbuser, $this->dbpwd);
        mysql_select_db($this->dbname, $linkss);
        $result=mysql_query("select * from {$this->tablename}", $linkss);
        $col=mysql_num_fields($result);
        mysql_close($linkss);
        return $col;
    }
 
    private function getarrs(){ //根据条件再次查询并返回结果
        $sql="select * from {$this->tablename} limit {$this->limit}, {$this->num}";
        $links=mysql_connect($this->dbadd, $this->dbuser, $this->dbpwd);
        mysql_select_db($this->dbname, $links); 
        $result=mysql_query($sql, $links); 
        while($arr=mysql_fetch_assoc($result)){
            $arrs[]=$arr;
        }
        return $arrs;
        mysql_close($links);
    }
 
    private function setlimit(){
        return ($this->page-1)*$this->num;
    }
 
    private function getpage(){
        $page=isset($_GET["page"]) ? $_GET["page"] : 1;
        $page=$page>$this->totalpage ? $this->totalpage : $page;
        $page=$page<1 ? 1 : $page;
        return $page;
    }
 
    private function gettotal(){    //得到表中所有记录的总数
        $link=mysql_connect($this->dbadd, $this->dbuser, $this->dbpwd);
        mysql_select_db($this->dbname, $link);
        $result=mysql_query("select * from {$this->tablename}", $link);
        $total=mysql_num_rows($result);
        mysql_close($link);
        return $total;
    }
 
    function __get($args){
        switch($args){
            case "arrs":    //根据条件查询出的结果，是二维数组
                return $this->arrs;
                break;
            case "totalpage":   //总页数
                return $this->totalpage;
                break;
            case "col": //总列数
                return $this->col;
                break;
            case "page":    //当前页
                return $this->page;
                break;
            case "nostart": //当前页显示的记录的起始条数
                return $this->nostart;
                break;
            case "noend": //当前页显示的记录的结束条数
                return $this->noend;
                break;
            case "head":    //首页按钮
                return $this->head;
                break;
            case "end": //尾页按钮
                return $this->end;
                break;
            case "last":  //上一页按钮
                return $this->last;
                break;
            case "nexts": //下一页按钮
                return $this->nexts;
                break;
        }
    }
}
?>