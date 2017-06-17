<?_head("Friends")?>
<script>
function Part(fname, lname, page, mail, nick, icq) {
 this.fname = fname;
 this.lname = lname;
 this.page = page;
 this.mail = mail;
 this.nick = nick;
 this.icq = icq;
}

function MakeArray(n) {
 this.length=n;
 for (var i=1;i<=n;i++) 
  this[i]=0;
 return this;
}

var color1="blue";
var color2="yellow";
var list=new MakeArray(40);
i=1;
list[i++] = new Part("Bart","Baus","",
 "euro195@tornado.be", "kenwood","2583867");
list[i++] = new Part("Kristof","Berben","http://bewoner.dma.be/kberben/",
 "kberben@dds.nl", "kristof","2265822");
//list[i++] = new Part("Luc","Cardinaels","http://cbin.luc.ac.be/~mail03/",
// "mail03@rsftew.luc.ac.be", "cardi","");
list[i++] = new Part("Sarah","Carlier","http://www.student.kuleuven.ac.be/~m9714982/",
 "sarah.carlier@student.kuleuven.ac.be", "debaser","");
list[i++] = new Part("Joost","Damad","http://www.cs.kuleuven.ac.be/~damad/",
 " Joost.Damad@cs.kuleuven.ac.be", "andete","");
list[i++] = new Part("Ulrik","De Bie","http://uly2.arts.kuleuven.ac.be/~winmute/",
 "mailto:winmute@linux.cc.kuleuven.ac.be", "winmute","");
list[i++] = new Part("Danielle","Dekandelaer","http://www.chez.com/pebbles/",
 "ddekande@igwe7.vub.ac.be", "vespa","");
list[i++] = new Part("Peter","De Schrijver","",
 "schrijvp@sh.bel.alcatel.be", "p2","");
list[i++] = new Part("Patrik","Fagard","http://www.ping.be/~ping2442/",
 "Patrik.Fagard@ping.be", "pf","357048");
list[i++] = new Part("Sofie","Goderis","",
 "sgoderis@vub.ac.be", "tzusje","2915107");
//list[i++] = new Part("Manu","Heirbaut","",
// "manu@glo.be", "San Goku","981106");
list[i++] = new Part("Vincent","Homans","http://www.luc.ac.be/~9511754/",
 "9511754@luc.ac.be", "","");
list[i++] = new Part("Koen","Houben","",
 "ialone@dma.be", "ialone","");
list[i++] = new Part("Yasmine","Hoydonckx","",
 "djaz@dot.digibel.be", "djaz","");
list[i++] = new Part("Christophe","Jacquet","http://www.xs4all.be/hasselt/cj.html",
 "Christophe.Jacquet@advalvas.be", "cj","389765");
list[i++] = new Part("Benny","Ketelslegers","http://cbin.luc.ac.be/~mail350/index.html",
 "mail350@rsftew.luc.ac.be", "TCM","2708563");
list[i++] = new Part("Jo","Klaps","http://www.geocities.com/SiliconValley/Bay/2216/",
 "Jo.Klaps@advalvas.be", "DevNull","4543030");
//list[i++] = new Part("Kris","Lemmens","http://titan.glo.be/bosuil/",
// "kris.lemmens@skynet.be", "krisje","");
//list[i++] = new Part("Anthony","Liekens","http://alife.santafe.edu/~liekens/",
// "liekens@alife.santafe.edu", "MoobY","1617711");
//list[i++] = new Part("Javier","Medina","http://bewoner.dma.be/javier/",
// "javier@dma.be", "","");
list[i++] = new Part("Serge","Morabito","http://www.luc.ac.be/~9410432/",
 "9410432@luc.ac.be", "","");
list[i++] = new Part("Pascal","Mouret","",
 "mouret@lim.univ-mrs.fr", "","");
//list[i++] = new Part("Roel","Niesen","http://www.tornado.be/~ronie/",
// "roel@tornado.be", "roel","376378");
list[i++] = new Part("Jasper","Nuyens","http://www.luc.ac.be/~9512087/",
 "jasper@best.be", "internet","");
//list[i++] = new Part("Kristof","Rutten","http://bewoner.dma.be/Slof/",
// "Slof@dma.be", "Slof","");
//list[i++] = new Part("Antony","Slabinck","",
// "antony.slabinck@sisa.be", "","381190");
//list[i++] = new Part("Dimitri","Smagghe","",
// "Dimitry@dma.be", "","");
list[i++] = new Part("Ans","Tambuyzer","",
 "cubixx@dma.be", "CUbiXX","");
//list[i++] = new Part("Kristien","Tambuyzer","",
// "tofke@king.glo.be", "Caman","");
list[i++] = new Part("Kris","Ulens","http://urc1.cc.kuleuven.ac.be/~m9208705/",
 "chris.ulens@student.kuleuven.ac.be", "moonwaver","");
list[i++] = new Part("Christophe","Van Ginneken","http://king.glo.be/~chocotof/",
 "tofke@king.glo.be", "chocotof","911680");
list[i++] = new Part("Stephan","Vandenborn","http://www.club.innet.be/~year9239/",
 "darkman@club.innet.be", "darky","820794");
list[i++] = new Part("Jan","Vanvoorden","http://www.geocities.com/Paris/Metro/3115/",
 "babayaro@dds.nl","","");
list[i++] = new Part("Marcus","Wie&euml;rs","http://www.ping.be/~ping2881/",
"Marcus.Wieers@ping.be", "siklaj","");
 for (var j = 1; j < i; j++) {
  with (list[j]) {
   document.writeln('<li> ',lname,' <b>',fname,'</b>');
   if (nick!="")
    document.writeln(' <font size=1>[',nick,']</font>');
   if (page!="")
    document.writeln('<a href="',page,'" onMouseOver="status=\'',fname,'`s homepage\'; return true;" onMouseOut="status=\'\'; return true;"><img src="/images/efolder1.gif" border="0"></a>');
   if (mail!="")
    document.writeln('<a href="mailto:',mail,'?subject=via_DAGMENU_!!" onMouseOver="status=\'Mail ',fname,'\'; return true;" onMouseOut="status=\'\'; return true;"><img src="/images/eutil11.gif" border="0"></a>');
   if (icq!="")
    document.writeln('<a href="http://wwp.mirabilis.com/',icq,'" target="MAIN" onMouseOver="status=\'Page ',fname,'\'; return true;" onMouseOut="status=\'\'; return true;"><img src="/images/icq.gif" border="0"></a>');
//   if (nick!="")
//    document.writeln('<a href="../hasselt/_bezoek.html#',nick,'"><img src="eutil16.gif" border="0" align="right"></a>');
  }
 }
</script>
<?_foot()?>
