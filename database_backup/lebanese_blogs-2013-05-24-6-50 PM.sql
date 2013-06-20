# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: lebanese_blogs
# Generation Time: 2013-05-24 18:50:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table blogs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `blog_id` varchar(50) NOT NULL DEFAULT '',
  `blog_name` varchar(150) DEFAULT NULL,
  `blog_description` text,
  `blog_url` varchar(255) DEFAULT NULL,
  `blog_author` varchar(150) NOT NULL DEFAULT '',
  `blog_author_twitter_username` varchar(50) DEFAULT NULL,
  `blog_rss_feed` varchar(255) DEFAULT NULL,
  `blog_tags` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;

INSERT INTO `blogs` (`blog_id`, `blog_name`, `blog_description`, `blog_url`, `blog_author`, `blog_author_twitter_username`, `blog_rss_feed`, `blog_tags`, `id`)
VALUES
	('247momonduty','24/7 Mom on Duty','Parenting Tips and Tricks. All about kids, kids and some more kids. What do I do?','http://247momonduty.com','Lama T',NULL,'http://www.247momonduty.com/feeds/posts/default','parenting',1),
	('abirghattas','Abir Ghattas','Activist, blogger, photographer, techie, feminist • Advocacy Manager','http://abirghattas.com/','Abir Ghattas','AbirGhattas','http://abirghattas.com/feed/','activism',2),
	('alexandra-designs','Dounia Alexandra Design','Master\'s student in Packaging Design at Pratt Institute. I have a BS in Graphic Design from LAU, Beirut. I am a freelancer on the side','http://alexandra-designs.com/','Dounia Nassar','dounianassar','http://alexandra-designs.com/feed/','design, art',3),
	('alextohme','Strategy and Business in the Middle East','Covering digital, retail, startups, innovation, futurism, mobile and other','alextohme.com','Alex Tohme','alextohme','http://alextohme.com/rss','business, strategy',4),
	('arabglot','arabglot الناطق بالضاد','culture-society-language of the Arab world','http://www.arabglot.com','Christopher Neil','arabglot','http://www.arabglot.com/feeds/posts/default',NULL,5),
	('arabsaga','ArabSaga','A reading of current developments and future trends in the Middle East.','http://arabsaga.blogspot.com','ArabSaga',NULL,'http://arabsaga.blogspot.com/feeds/posts/default',NULL,6),
	('armigatus','Armigatus','Random events in Lebanon','http://armigatus.wordpress.com/','Armigatus',NULL,'http://armigatus.wordpress.com/feed',NULL,7),
	('atrissi','The Blog of Tarek Atrissi','Arabic Type, Typography, Design and Visual Culture: The Blog of Tarek Atrissi','http://blog.atrissi.com/','Tarek Atrissi','atrissi','http://blog.atrissi.com/feed/','design, art',8),
	('backinbeirut','Back in Beirut','Articles and snapshots: Lebanon, the Middle East and further afield','http://backinbeirut.blogspot.com/','Paul Cochrane',NULL,'http://backinbeirut.blogspot.com/feeds/posts/default','business',9),
	('bambisoapbox','Bambi\'s Soapbox','Bambi’s Soapbox is a blog about life as a twenty-something living in Lebanon. It is written by me, Farrah Berrou. I’m a doe, a deer, a female deer. But I’m also, a ray, a drop of golden sun. Bambi is a name I call myself, and I have a long long way to run.','http://bambisoapbox.wordpress.com/','Farrah Berrou','farrahberrou','http://bambisoapbox.wordpress.com/feed/','society',10),
	('beirut5ampere','بيروت 5 امبير','رئيس كتلة الفظاعة - منسق اتحاد المنشقين عن قوى الأمر الواقع','http://www.beirut5ampere.org/','MoxyBeirut','moxybeirut','http://www.beirut5ampere.org/?feed=rss2','society',11),
	('beirutbeltway','From Beirut to the Beltway','\"I care not much for a man\'s religion whose dog and cat are not the better for it\" -- Abraham Lincoln','http://www.beirutbeltway.com/','AK','beirutbeltway','http://www.beirutbeltway.com/beirutbeltway/atom.xml','politics',12),
	('beirutdriveby','Beirut Drive-by Shooting','Here are some of what Lebanese are subjected to on a daily basis. Enjoy or suffer along with us.','http://beirutdriveby.blogspot.com/','Driveby','beirutdriveby','http://beirutdriveby.blogspot.com/feeds/posts/default',NULL,13),
	('beirutista','Beirutista','Serving Beirut to the public.','http://beirutista.blogspot.com/','Danielle Issa','beirutista','http://beirutista.blogspot.com/feeds/posts/default','society',14),
	('beirutiyat','خربشات بيروتية','لم يعد هناك مكان آمن سوى سنتيمترات مربعة في الجمجمة – جورج أورويل','http://beirutiyat.wordpress.com/','Assaad Thebian','Beirutiyat','http://beirutiyat.wordpress.com/feed/','activism',15),
	('beirutntsc','Never Twice the Same City','Beirut, Never Twice the Same City','http://beirutntsc.blogspot.com','Tarek Chemaly',NULL,'http://beirutntsc.blogspot.com/feeds/posts/default','advertising, design',16),
	('beirutreport','The Beirut Report','An inside look at Lebanon, the Middle East and its media','http://beirutreport.com','Habib Battah','habib_b','http://www.beirutreport.com/feeds/posts/default','activism, politics',17),
	('beirutspring','Beirut Spring','Blogging Lebanese politics, business and society since 2005','http://beirutspring.com','Mustapha Hamoui','beirutspring','http://beirutspring.com/blog/feed','politics, society',18),
	('bikaffe','Bikaffe','اكتب ب كفّي ما يكفي لنقول بكفّي !','http://bikaffe.wordpress.com/','Rabih Amhaz','bikaffe','http://bikaffe.wordpress.com/feed/','politics',19),
	('bilamaliyeh','Bil amaliyeh','باللبناني .... المشبرح','http://bilamaliyeh.wordpress.com/','Milad Issa','MiladIssa','http://bilamaliyeh.wordpress.com/feed/','politics',20),
	('blkbtrfli','Lebanese Voices\' Blog','Because those that should be heard have no voice but those that shouldn\'t have media stations','http://blkbtrfli.wordpress.com/','Racha Ghamlouch','LebaneseVoices','http://blkbtrfli.wordpress.com/feed/','activism, society',21),
	('blogbaladi','Blog Baladi','a non-political Lebanese blog that tackles various issues related to the Lebanese society','http://blogbaladi.com','Najib Mitri','LeNajib','http://blogbaladi.com/feed/','society',22),
	('bloggingfairtradelebanon','Blogging Fair Trade Lebanon','Protecting the rights and working wonditions of local producers. Helping producers find customers. Cutting out the middlemen. Paying fairer wages. Improving quality control and product design. Creating a long-term commitment','http://bloggingfairtradelebanon.blogspot.com/','Various','FairTradeLeb','http://bloggingfairtradelebanon.blogspot.com/feeds/posts/default','activism, agriculture',23),
	('blogtoblague','Blog to Blague','The world as I see it (by Rita D.)','http://blogtoblague.wordpress.com/','Rita Dahdah','missrd','http://blogtoblague.wordpress.com/feed/','society',24),
	('brofessionalreview','Brofessional Review','lebanese / design / advertising / fashion / media','http://brofessionalreview.com/','Admin X','BrofessionalR','http://brofessionalreview.com/feed/','advertising, design',25),
	('chroniquesbeyrouthines','Chroniques beyrouthines','chroniques et reportages sur le Liban, depuis Beyrouth','http://chroniquesbeyrouthines.20minutes-blogs.fr','David Hury','BeirutPrints','http://chroniquesbeyrouthines.20minutes-blogs.fr/atom.xml','politics',26),
	('cloudoflace','Cloud of Lace','All that I love in this life. From recipes to fashion, and some lifestyle & home improvement projects. It is going to feature a lot of what inspires me- big or small: Arts, grand fashion houses, local Lebanese designers, handmade ornaments and apparel, simple projects… etc','http://cloudoflace.com/','Hiba Khalil','hibakhalil','http://cloudoflace.com/feed/','fashion, society',27),
	('code4word','Code4word','On this blog you will find articles and tutorials that tackle web and application development related material along with posts about Microsoft platforms, products, technologies, and resources that I hope you will find interesting and informative.','http://code4word.com','Rami Sarieddine','RamieSays','http://code4word.com/feed','tech',28),
	('confettiblues','CONFETTI','Confetti is a scrapbook of the little thoughts, ideas, dreams, memories, etc that add colour to my life','http://confettiblues.wordpress.com/','Confetti','ConfettiBlues','http://confettiblues.wordpress.com/feed/','food',29),
	('consumedly','Consumedly','food, feelings, flavors.','http://consumedly.wordpress.com/','consumedly','Consumedly','http://consumedly.wordpress.com/feed/','society, food',30),
	('countlesslittlethings','Countless Little Things','\"Little by little does the trick.\" Aesop','http://countlesslittlethings.wordpress.com/','Marie Nakhle','MarieNakhle','http://countlesslittlethings.wordpress.com/feed/',NULL,31),
	('dirtykitchensecrets','Dirty Kitchen Secrets','Middle Eastern and Lebanese Recipes. Lick your plate clean..','http://dirtykitchensecrets.com/','Bethany Kehdy','Bethanykd','http://www.dirtykitchensecrets.com/feed/','food',32),
	('dustywyndow','Dusty Wyndow Blog','A total mess inside an anonymous artist\'s soul','http://dustywyndow.blogspot.com/','Natheer Halawani','Nathhalawani','http://dustywyndow.blogspot.com/feeds/posts/default','photography',33),
	('endashemdash',' Nour Has a Tumblog',NULL,'http://endashemdash.com/','Nour Malaeb','nourmalaeb','http://endashemdash.com/rss','society',34),
	('ethiopiansuicides','Ethiopian Suicides','... and Nepalese and Eritrean and Bengali and Sri Lankan and Filipino and Malagasy who work as domestic workers in Lebanese homes.','http://ethiopiansuicides.blogspot.com/','Wissam','mdwsuicides','http://ethiopiansuicides.blogspot.com/feeds/posts/default','society',35),
	('eyeontheeast','Eye on the East','Following Lebanon & the Arab world so that nothing is left unsaid','http://eyeontheeast.org/','Marina Chamma','eyeontheeast','http://eyeontheeast.org/feed/','politics',36),
	('fashiontotracy','Fashion To Tracy','Lebanese fashion blogs','http://www.fashiontotracy.com/','Tracey Ghazal','TracyGhazal','http://www.fashiontotracy.com/feeds/posts/default?alt=rss','fashion',37),
	('figo29','Figo29\'s Blog','For football and me','http://figo29.com/','figo','figo29','http://figo29.com/feed/','sports',38),
	('freethinkinglebanon','Free Thinking Lebanon','A voice of reason from a country crippled by faith','http://freethinkinglebanon.com','Elie Atik','Eli_FTL','http://www.freethinkinglebanon.com/feeds/posts/default','politics',39),
	('funkyozzi','.: From Beirut with Funk :.','Powered by Independence 05','http://blog.funkyozzi.com/','Liliane Assaf','FunkyOzzi','http://blog.funkyozzi.com/feeds/posts/default','society',40),
	('gghali','Gabe\'s','A little something about everything','http://gghali.blogspot.com/','Gabriel Ghali','gabrielghali','http://gghali.blogspot.com/feeds/posts/default','tech',41),
	('ghazayel','مجة','مـــــجّــــة | تأخذك بعيداً إلى الواقعية','http://ghazayel.wordpress.com/','Mahmoud Ghazayel','ghazayel','http://ghazayel.wordpress.com/feed/','society, politics',42),
	('gimmemoah','GIMMEMOAH!','Because too much is not enough','http://gimmemoah.wordpress.com/','Philippe','GhPhilippe','http://gimmemoah.wordpress.com/feed/',NULL,43),
	('gingerbeirut','Ginger Beirut',NULL,'http://gingerbeirut.com','Georgia Paterson Dargham',NULL,'http://www.gingerbeirut.com/feed','society',44),
	('ginosblog','Gino\'s Blog',NULL,'http://ginosblog.com/','Gino Raidy','ginoraidy','http://ginosblog.com/feed/','society',45),
	('globalnuancestheblog','globalnuances','A blog on culture from my humble sensibilities to your thoughts','http://globalnuancestheblog.com/','Nett Davis','nzanned','http://globalnuancestheblog.com/feed/','politics',46),
	('globalvoicesonline','Global Voices Online (Lebanon)','The world is talking, are you listening? ','http://globalvoicesonline.org/-/world/middle-east-north-africa/lebanon/','Various','globalvoices','http://globalvoicesonline.org/-/world/middle-east-north-africa/lebanon/feed/','politics, society',47),
	('greenresistance','Green Resistance','Discussion on struggles for change and connections between the environment, economy, and politics by Rania Masri ','http://greenresistance.wordpress.com/','Rania Masri ','rania_masri','http://greenresistance.wordpress.com/feed/','activism, environmentalism',48),
	('h20-platform','The Platform','I have a background in web development, image processing, programming and networking and for that you should trust my posts.','http://h20-platform.blogspot.com/','Hadi Fr','hadi_frht','http://h20-platform.blogspot.com/feeds/posts/default','tech',49),
	('hahussain','ربيع العرب','مدونة الباحث والصحفي حسين عبدالحسين','http://hahussain.blogspot.com/','Hussain AbdulHussain','hahussain','http://hahussain.blogspot.com/feeds/posts/default','politics',50),
	('haykhabriyeh','Hay Khabriyeh!','Lebanese Refreshing Positive News!','http://www.haykhabriyeh.com/','Hay Khabriyeh','HayKhabriyeh','http://www.haykhabriyeh.com/feed/','society',51),
	('healthnhorizons','Health \'n\' Horizons','Health And Horizons','http://healthnhorizons.com/','Christele Daccache','healthnhorizons','http://healthnhorizons.com/feed/','food, health',52),
	('hishamad','Cola W Calset','my thoughts and experiences, from cola to calset','http://hishamad.wordpress.com/','Hisham Assaad','hishamad','http://hishamad.wordpress.com/feed/','society',53),
	('homoslibnani','Homos Libnani','just one random gay guy from Beirut','http://homoslibnani.wordpress.com/','HL','homoslibnani','http://homoslibnani.wordpress.com/feed/','society',54),
	('hummusforthought','Hummus For Thought','(by HummusForThought)','http://hummusforthought.com/','Joey Ayoub','joeyayoub','http://hummusforthought.com/feed/','society',55),
	('hummusnation','جمهورية الحمص','وكالة الانباء الرسمية، جمهورية الحمص','http://www.hummusnation.net/','Hummus Nation','hummusnation','http://www.hummusnation.net/feed/','humor',56),
	('inkontheside','Ink On the Side','A geeky programmer with a sarcastic sense of humor','http://inkontheside.com/','Sareen Akharjalian','sareen_ak','http://inkontheside.com/feed/','society, comics, humor',57),
	('ivysays','Ivy Says','I’m Ivy, an anonymous blogger in Beirut. I’m an absolute slave for fashion and I always shop and tell. Food is a hobby, burgers are a vice and baking is a passion. I’ve also appointed myself this city’s fashion crime scene reporter','http://ivysays.com/','Ivy','ivysblog','http://ivysays.com/feed/','fashion',58),
	('jadaoun','Lebanon News: Under Rug Swept','Home of the \"Looks Like Beirut\" Certificate','http://jadaoun.com/','Jad Aoun','LebanonNewsURS','jadaoun.com/feed','society',59),
	('jneen8','jneen8 « The Cemetery of Random Thoughts','The Cemetery of Random Thoughts','http://jneen8.wordpress.com/','Jeanine H','jneen8','http://jneen8.wordpress.com/feed/','society',60),
	('joesbox','Joe\'s Box','Have a look inside my box','http://joesbox.com','Youssef Alam','JoesBox','http://www.joesbox.com/feeds/posts/default','society, advertising, design',61),
	('johayna','جـهينة ...','جهينة خالدية','http://johayna.blogspot.com/','جهينة خالدية','Johaynah','http://johayna.blogspot.com/feeds/posts/default','society, politics',62),
	('jou3an','مواطن جوعان','الانسان بالنهاية قضية، لا تلم الكافر في هذا الزمن الكافر... فالجوع ابو الكفار...','http://jou3an.wordpress.com/','خضر سلامة','jou3an','http://jou3an.wordpress.com/feed/','politics',63),
	('kadmous','Kadmous','Lebanese and Lebanon','http://www.kadmous.org/wp/','Kadmous','','http://www.kadmous.org/wp/?feed=rss2','society',64),
	('karlremarks','Karl Remarks','Middle East politics, culture and satire','http://www.karlremarks.com','Karl Sharro','KarlreMarks','http://www.karlremarks.com/feeds/posts/default','politics, humor, comics',65),
	('lamathinks','Lama\'s Scrapbook','They say sharing is caring. I say it\'s an exercise in self-adulation.','http://lamathinks.blogspot.com/','Lama Bashour','lama_b','http://lamathinks.blogspot.com/feeds/posts/default','society,',66),
	('languidlyurged','Languidly Urged','And as lovable as a pink, overfed whale.','http://languidlyurged.wordpress.com/','Linda Abi Assi','lindaabiassi','http://languidlyurged.wordpress.com/feed/','society',67),
	('larmoiredelana','L\'armoire de Lana','Fashionably yours...','http://www.larmoiredelana.com/','Lana Sahely','LaSahely','http://www.larmoiredelana.com/?feed=rss2','fashion',68),
	('lbcblogs','Lebanese Blogging Community','News is Monologue, Contribute & Create the Dialogue.','http://lbcblogs.com','Nadine Mazloum','LBCBlogs','http://lbcblogs.com/feed/','society, politics',69),
	('lebaneseblogs','Lebanese Blogs Meta Blog','Lebanese Blogs\' own blog about the development of the platform','http://lebaneseblogs.com/blog/','Mustapha Hamoui','lebaneseblogs','http://lebaneseblogs.com/blog/?feed=rss2','society',70),
	('lebanesecomics','Malaak, Angel of Peace',NULL,'http://lebanesecomics.blogspot.com','Joumana Medlej','joumajnouna','http://lebanesecomics.blogspot.com/feeds/posts/default','comics',71),
	('lebaneseexpatriate','The Lebanese Expatriate','Lebanon from the lens of another Lebanese living abroad','http://lebaneseexpatriate.wordpress.com/','Adel Nehmeh','adelnehmeh','http://lebaneseexpatriate.wordpress.com/feed/','politics',72),
	('lebanonspring','Lebanon Spring Blog','A Lebanese political blog','http://lebanonspring.com/','The Zako','lebanonspring','http://lebanonspring.com/feed/','politics',73),
	('leclicblog','Le Clic','Un blog dédié aux blogs et autres médias sociaux. (par Rania Massoud)','http://leclicblog.wordpress.com/','Rania Massoud','RaniaMassoud','http://leclicblog.wordpress.com/feed/','society',74),
	('leelouzworld','Leelouz World','Be the change you want to see in the world - Gandhi','http://leelouzworld.wordpress.com/','Leila Jisr Moussa','leelouzworld','http://leelouzworld.wordpress.com/feed/','society',75),
	('lifeandstyleandco','Life and Style and Co','Briefly about anything that fascinates me, that inspires me, that make me feel as happy as eating chocolate and as getting a hug and kiss from my two year old daughter!','http://lifeandstyleandco.com','Rita Lamah Hankach','ritalamah','http://lifeandstyleandco.com/feed/','fashion',76),
	('lifewithsubtitles','Life With Subtitles','A place for those who, like me, find the world a heck of a crazy place to live in, and feel as if life speaks a language they can\'t quite understand.','http://lifewithsubtitles.com','Fadi Bitar','SurvivalFirst','http://www.lifewithsubtitles.com/feeds/posts/default','society',77),
	('lobnene','لبناني','مساحة حرة لنقد 14 و 8 آذار ... بلا قيود غير المواطنية','http://lobnene.wordpress.com/','Ahmad M. Yassine','Lobnene_Blog','http://lobnene.wordpress.com/feed/','politics',78),
	('loveanon','LOVEanon','A blog about love, relationships, and dating with a Lebanese twist.','http://www.loveanon.org/','Mike Oghia','MikeOghia','http://www.loveanon.org/feeds/posts/default?alt=rss','society',79),
	('lunasafwan','Luna Safwan','Reporter','http://lunasafwan.wordpress.com/','Luna Safwan','LunaSafwan','http://lunasafwan.wordpress.com/feed/','politics',80),
	('majnouna-blog','Mirth and Folly',NULL,'http://majnouna-blog.blogspot.com','Joumana Medlej','joumajnouna','http://majnouna-blog.blogspot.com/feeds/posts/default','society',81),
	('majnouna-khatt','Majnouna: Khatt','My explorations in Khatt (Arabic calligraphy) are a modern take on a traditional art form, influenced by master calligrapher Samir Sayegh with whom I have been working closely since 2007.','http://majnouna-khatt.blogspot.com','Joumana Medlej','joumajnouna','http://majnouna-khatt.blogspot.com/feeds/posts/default','art, design,',82),
	('marianachawi','Maria Studio','Art, Jewelry, and its relation with Psychology','http://marianachawi.blogspot.com/','Maria Nachawi','Mariastudio','http://marianachawi.blogspot.com/feeds/posts/default','art, design, society',83),
	('marketinginlebanon','Marketing in Lebanon','Marketing in Lebanon','http://www.marketinginlebanon.com/','Youman Zod','youmny','http://www.marketinginlebanon.com/feeds/posts/default','business, marketing',84),
	('meandbeirut','Me & Beirut','Snippets of my life in Beirut: Cozy little cafés and restaurants I discover, exciting people I meet, pretty things I buy, challenging questions I have on my mind or just interesting things I read','http://meandbeirut.com/','Hanan','meandbeirut','http://meandbeirut.com/feed/','society',85),
	('meemeee82','Babbles Of A Local Girl','My space, an exit to all those ideas that dwell in my mind, incarnated in words, wrapped up with bits of feelings… (by Ymn)','http://meemeee82.wordpress.com/','Ymnn','MsYmn','http://meemeee82.wordpress.com/feed/','society, politics',86),
	('memy50shadesandl',' Me My 50 Shades and L','In Love with L = Live, Love, Laugh. Some call me Freud!','http://memy50shadesandl.com','Myrna AM El Khoury','myrrnzz','http://memy50shadesandl.com/feed/','society, fashion',87),
	('menaribo','Men Aribo - من أريبو',' من أريبو','http://menaribo.com/','Ralph','Aamchit','http://menaribo.com/feed/','politics',88),
	('mexicaninbeirut','From Mexico to Beirut','A Mexican living in Lebanon and writing about her observations','http://mexicaninbeirut.blogspot.com/','Maria Ortiz Perez','mariasusername','http://mexicaninbeirut.blogspot.com/feeds/posts/default','society',89),
	('michcafe','Mich Café','Good Morning, Sabaho, Bonjour','http://michcafe.blogspot.com','Micheline Hazou','mich1mich','http://michcafe.blogspot.com/feeds/posts/default','society',90),
	('mideastwire','The Mideastwire Blog','Excerpts from the Arab and Iranian Media & Analysis of US Policy in the Region','http://mideastwire.wordpress.com/','Nicholas Noe',NULL,'http://mideastwire.wordpress.com/feed/','politics',91),
	('mindsoupblog','Mind Soup','Blowing your mind away','http://www.mindsoupblog.com/','Mohamed Hijazi','mindsoup','http://www.mindsoupblog.com/feeds/posts/default','society',92),
	('missfarah','Miss Farah','Teacher by day, blogger by night','http://www.missfarah.com/','Farah Ghazale','MissFarah_LB','http://www.missfarah.com/index.php/feed/','education',93),
	('moulahazat','Moulahazat','Notes And Reviews On Lebanese Politics','http://moulahazat.com/','Ramez Dagher','moulahazat','http://moulahazat.com/feed/','politics',94),
	('musiqati','Musiqati','The combination of vocal and/or instrumental sounds producing a beauty of form, harmony and emotional expression (by Amira)','http://musiqati.wordpress.com','Amira A','musiqati','http://musiqati.wordpress.com/feed/','music, society',95),
	('nadinemoawad','What if I Get Free?','Feminist Attempts','http://nadinemoawad.com','Nadine Moawad','nmoawad','http://www.nadinemoawad.com/feed/','activism, politics',96),
	('najissa','خرّوب و زنزلخت','ما هبّ و دبّ','http://najissa.wordpress.com/','Naji Issa',NULL,'http://najissa.wordpress.com/feed/','politics, society',97),
	('nakedbana2','نقد بنّاء','لأن النقد أب الثورة وجَدّ الحقيقة الآخرى','http://nakedbana2.wordpress.com/','Joe Hammoura','joehammoura','http://nakedbana2.wordpress.com/feed/','politics, society',98),
	('nasriatallah','Nasri Atallah','TALL AND HAIRY. ESTABLISHED 1982.','http://nasriatallah.com/','Nasri Atallah','NasriAtallah','http://www.nasriatallah.com/feed/','society',99),
	('nogarlicnoonions','No Garlic No Onions','Restaurants, Hotels and Food reviews from the four corners of the globe','http://nogarlicnoonions.com','Anthony Rahayel','NoGarlicNoOnion','http://www.nogarlicnoonions.com/feed/','food,',100),
	('nourspot','NourSpot','\"I believe that this is heaven to no one else but me\"','http://nourspot.blogspot.com/','Nour Kabbara','nourspot','http://nourspot.blogspot.com/feeds/posts/default','society',101),
	('nourzahi','نور زاهي','في زمن الرصاص والقذائف والمدافع، القلم مدفعي والكلمات ذخيرتي والورقة ساحة معركتي','http://nourzahi.wordpress.com/','Nour Al-Hassanieh','nourzahi','http://nourzahi.wordpress.com/feed/','society',102),
	('octavianasr','Octavia Nasr\'s Blog','In my pockets.. Memories and momentum.. Of life lived and moments cherished.. Like a child.. I\'m always ready for a surprise!','http://blog.octavianasr.com','Octavia Nasr','octavianasr','http://blog.octavianasr.com/feeds/posts/default','politics',103),
	('ohmyhappiness','Ohmyhappiness','Gay, atheist, activist, pacifist, Arab. Among other horrible things','http://ohmyhappiness.com/','Raja Farah','ohmyhappiness','http://ohmyhappiness.com/feed/','society',104),
	('phatimasbox','Phatima\'s Box','As simple as it gets...','http://phatimasbox.wordpress.com/','Phatima P. Hakimi','phatimahakimi','http://phatimasbox.wordpress.com/feed/','food',105),
	('photosoftheweek','POW | Photos Of the Week','Expect each week a post with the best photos in Lebanon and around the world','http://photosoftheweek.wordpress.com','Mahmoud Ghazayel','ghazayel','http://photosoftheweek.wordpress.com/feed/','photography, society',106),
	('piratebeirut','Pirate Beirut','Lebanese Music Downloads','http://piratebeirut.com','Pirate','piratebeirut','http://piratebeirut.com/feed','music',107),
	('plus961','Blog +961','Bringing you up-to-date news from Lebanon','http://plus961.com','Rami Fayoumi','plus961','http://plus961.com/feed/','society',108),
	('plush-beirut','Plush Beirut','Fashion In Beirut,Beirut Street Style, Middle East fashion, Parties, Arts, Runway, Personal Style,','http://plush-beirut.net','Deema J. Saidi','plushbeirut','http://www.plush-beirut.net/feeds/posts/default','fashion',109),
	('poshlemon','Posh Lemon\'s Blog','Ex-smoker, ex-coffee lover, and soon to be ex-Londoner. And sometimes I sound like a broken record.','http://poshlemon.blogspot.com','Posh Lemon','Poshlemon','http://poshlemon.blogspot.com/feeds/posts/default','society, politics',110),
	('qaph','Qaph','A Lebanese blog reading politics, books and civil society events','http://qaph.wordpress.com/','Hicham N','qaphblog','http://qaph.wordpress.com/feed/','politics',111),
	('qifanabki','Qifa Nabki','News and commentary from the Levant','http://qifanabki.com','Elias Muhanna','qifanabki','http://qifanabki.com/feed/','politics,',112),
	('rachaelhalabi','Racha El Halabi','You May Say I\'m A Dreamer, But I\'m Not The Only One','http://rachaelhalabi.wordpress.com/','Racha El Halabi','Racha93halabi','http://rachaelhalabi.wordpress.com/feed/','society, politics',113),
	('racing-thoughts','Racing Thoughts','Musings on life and stuff','http://racing-thoughts.com/','Joelle Hatem','joellehatem','http://racing-thoughts.com/feed/',NULL,114),
	('ranasalam','Rana Salam Design Blog','Rana Salam is celebrated for a vision which contemporises the Middle East through the power of design.','http://ranasalam.blogspot.com/feeds/posts/default','Rana Salam','ranasalam','http://ranasalam.blogspot.com/feeds/posts/default','design, art',115),
	('rationalrepublic','Rational Republic','This space was created in an effort to encourage constructive dialogue of social, economic, political and environmental issues. There will be a strong focus on developments in Lebanon.','http://rationalrepublic.blogspot.com/','Ghassan Karam',NULL,'http://rationalrepublic.blogspot.com/feeds/posts/default','economics, business, politics',116),
	('redlipshighheels','Red Lips High Heels','Middle Eastern Women&#039;s Rights Knowledge Base','http://www.redlipshighheels.com/','Dr. Pamela Chrabieh','redlipshh','http://www.redlipshighheels.com/feed/','society, activism',117),
	('rel4tivity','Rel4tivity','I am a Business Solutions Consulant and i blog whenever i have something to say','http://rel4tivity.wordpress.com/','Bilal Delly','BilalDelly','http://rel4tivity.wordpress.com/feed/','society',118),
	('remarkz','Remarkz','Footnotes on what came to be called the Middle East and beyond','http://remarkz.wordpress.com','Remarkz',NULL,'http://remarkz.wordpress.com/feed/','politics',119),
	('ritachemaly','Rita Chemaly\'s Blog','Political and Social activism in Lebanon and Abroad','http://ritachemaly.wordpress.com','Rita Chemaly','Ritachemaly','http://ritachemaly.wordpress.com/feed/','activism',120),
	('ritakml','Rita Kamel\'s Blog','When the light bulb lights up! – ritakml\'s blog','http://ritakml.info/','Rita Kamel','ritakml','http://ritakml.info/feed/','society',121),
	('saghbini','مدوّنة نينار','المدوّنة: مجرد نافذة للتنفّس، لانعاش الرئة بأفكار تتحرك ذهاباً وإياباً بيني وبين العابرين من هنا','http://saghbini.wordpress.com/','Tony Saghbiny','Saghbiny','http://saghbini.wordpress.com/feed/','activism, politics',122),
	('saharghazale','Un Peu de Kil Shi','A blog on design and life delicacies...','http://saharghazale.com','Sahar Ghazale','saharghazale','http://saharghazale.com/feed/','design, interior',123),
	('sansglutenabeyrouth','Sans Gluten A Beyrouth','Vivre :) sans gluten, c\'est possible, même à Beyrouth!','http://sansglutenabeyrouth.blogspot.com/','Sans Gluten','sansglutenabey','http://sansglutenabeyrouth.blogspot.com/feeds/posts/default','food, health',124),
	('seenbymaya','Seen by Maya','random musings, inspirations & works...','http://seenbymaya.blogspot.com','Maya Metni','mayametni','http://seenbymaya.blogspot.com/feeds/posts/default','food, ',125),
	('seeqnce','seeqnce | blog','Highly Acclaimed Web & Mobile Startup Accelerator','http://blog.seeqnce.com/','Samer Karam','seeqnce','http://blog.seeqnce.com/?feed=rss2','business,',126),
	('sietske-in-beiroet','Sietske In Beiroet','musings of a Dutch lady who came to Beirut as a journalist. The plan was to stay for 3 months; some 20 years later she is still here.','http://sietske-in-beiroet.blogspot.com/','Sietske Galama','galama','http://sietske-in-beiroet.blogspot.com/feeds/posts/default','society',127),
	('sleeplessbeirut','Sleepless in Beirut','Love and Chaos in between the streets','http://sleeplessbeirut.blogspot.com/','Sleepless','sleeplessbeirut','http://sleeplessbeirut.blogspot.com/feeds/posts/default','society',128),
	('smex','SMEX','Channeling Advocacy','http://smex.org','Various','SMEX','http://www.smex.org/feed/','activisim, tech',129),
	('smileyface80','مدونة بيسان','أؤمن ان خلف كل خيبة امل جديد، وان بعد كل هزيمة، لا بد من نصر قادم','http://smileyface80.wordpress.com/','بيسان',NULL,'http://smileyface80.wordpress.com/feed/','society',130),
	('snapshotscenes','Snapshot Scenes','Thoughts and photos from Beirut and Lebanon','http://snapshotscenes.blogspot.com/','Celine Khairallah','SceneBeirut','http://snapshotscenes.blogspot.com/feeds/posts/default','society, photography',131),
	('southoak','سنديانة الجنوب','حيث يجتمع العلم و الثقافة','http://southoak.blogspot.com/','Adel Noureddine','adelnoureddine','http://southoak.blogspot.com/feeds/posts/default','politics,',132),
	('speaktheblues','Speakin\' the Blues','All Blues... All day, all night','http://speaktheblues.blogspot.com/','Ali Sleeq','AliSleeq','http://speaktheblues.blogspot.com/feeds/posts/default','music',133),
	('stateofmind13','A Separate State of Mind',NULL,'http://stateofmind13.com','Elie Fares','eliefares','http://stateofmind13.com/feed/','politics, society',134),
	('strawberryblu','Strawberry Blu','ASK anything about FOOD: Dieting, Nutrition, Health & Cooking','http://strawberryblu.com/','Cynthia Bu Jawdeh','strawberryblu','http://strawberryblu.com/feed/','food, health',135),
	('survivalfirst','The On-The-Go Blog','A Lebanese living in Stockholm, slowly discovering the joys of Scandinavian life with a Lebanese perspective, and occasionally bringing a Swedish perspective back to Beirut.','http://survivalfirst.tumblr.com/','Fadi Bitar','SurvivalFirst','http://feeds.feedburner.com/OnTheGoBlog','society',136),
	('tajaddod-youth','Tajaddod Youth','Tajaddod Youth is the youth branch of the Democratic Renewal Movement ','http://tajaddod-youth.com/','Tajaddod Youth','TajaddodYouth','http://tajaddod-youth.com/feed/atom','politics',137),
	('tasteofbeirut','Taste Of Beirut','Lebanese Food Recipes for Home cooking','http://tasteofbeirut.com','Joumana Accad','tasteofbeirut','http://www.tasteofbeirut.com/feed/','food',138),
	('tech-ticker','Tech Ticker','A Technology and gadget online magazine, stuffed with news and reviews of the latest devices and gadgets. Tech-Ticker is headquartered in Beirut, Lebanon.','http://tech-ticker.com/','Tech-Ticker','techtickertweet','http://feeds.feedburner.com/Tech-Ticker','tech',139),
	('TerroristDonkey','Thuraya & The Terrorist Donkey ','I\'m not just a donkey - I\'m a terrorist one','http://theterroristdonkey.blogspot.com/','Terrorist Donkey','TerroristDonkey','http://theterroristdonkey.blogspot.com/feeds/posts/default','politics,',140),
	('the-opinion','The Opinion','Jessica O.pinion on Pretty Much Everything','http://the-opinion.net/','Jessica O.','Jessica_Obeid','http://the-opinion.net/feed/','politics',141),
	('theadsgarage','The Ads Garage','Cars? Ads? CarAds!!','http://theadsgarage.com','JP Zakher','JPZakher','http://theadsgarage.com/feed/','cars',142),
	('theclosetclause','The Closet Clause','Fashion Blog, Fashion News Daily','http://www.theclosetclause.com/','The Closet Clause','theclosetclause','http://www.theclosetclause.com/feeds/posts/default?alt=rss','fashion',143),
	('thecodeship','The Code Ship','Sailing through a sea of code','http://www.thecodeship.com/','Ayman Farhat','aymanfarhat','http://feeds.feedburner.com/thecodeship/yaMJ','tech',144),
	('thecubelb','The Cube','A place where Lebanese book lovers talk about reading and books','http://thecubelb.wordpress.com','Various','TheCubeLB','http://thecubelb.wordpress.com/feed/','books',145),
	('thedscoop','The D. Scoop','Lebanese fashion addict who?s been constantly following up and looking for answers','http://thedscoop.com','Dalia Saad','daliasaad89','http://www.thedscoop.com/rss','fashion',146),
	('thejrexpress','The JR Express','Marketing, Creativity, Technology and More ...','http://thejrexpress.com/','Jad Rahme','JadRahme','http://thejrexpress.com/feed/','tech, marketing',147),
	('thepresentperfect','The Present Perfect','Living for the present. My life in Beirut','http://thepresentperfect.wordpress.com/','Lyndsay','Lindsay_NYC','http://thepresentperfect.wordpress.com/feed/','society',148),
	('tomybeirut','To my Beirut','Á mon Beyrouth…','http://tomybeirut.com','Natasha Choufani','natashachoufani','http://tomybeirut.com/feed/','society',149),
	('toomextra','Toom Extra','\"Toom Extra\" is a social blog that criticizes or encourages Lebanese activities, news, actions and traditions in a style filled with humor and sarcasm.','http://toomextra.com/','Various','toomextra','http://www.toomextra.com/feeds/posts/default','society',150),
	('trella','مدونة تريلا','خبريات لبنانية متصالحة مع ماضيها  ','http://trella.org','Imad Bazzi','trellalb','http://trella.org/feed','politics',151),
	('viewoverbeirut','View Over Beirut','Beyond the news','http://viewoverbeirut.wordpress.com/','Ana Maria Luca','aml1609','http://viewoverbeirut.wordpress.com/feed/','politics',152),
	('wanderingviola','The Journeys of Wandering Viola','Viola is a girl exploring the Universe one planet at a time. With the help of her magic umbrella, she travels from world\r\nto world meeting the strange, funny or inspiring people who live there.','http://wanderingviola.com/category/blog/','Nadine Feghaly','nadinefeghaly','http://wanderingviola.com/category/blog/feed/','comics, society',153),
	('whenhopespeaks','When Hope Speaks . أمل إن حكت','A Hopeful Lebanese… yes some of those still exist','http://whenhopespeaks.wordpress.com','Amal Al Dahouk','wh0pe','http://whenhopespeaks.wordpress.com/feed/','society, business',154),
	('witchylisa','Witchy Lisa','Abandon all decency all ye who surf here','http://witchylisa.wordpress.com/','Witchy Lisa',NULL,'http://witchylisa.wordpress.com/feed/','society',155),
	('womanunveiled','إِمْرَأَةْ تَنْكَشِفْ','Seeing the World with Unveiled Eyes','http://womanunveiled.com/','Woman Unveiled','WomanUnveiled','http://womanunveiled.com/feed/','activism, politics',156),
	('woodenbeirut','Josh Wood','A journalist\'s observations on Lebanon and elsewhere','http://woodenbeirut.wordpress.com/','Josh Wood','woodenbeirut','http://woodenbeirut.wordpress.com/feed/','politics',157),
	('younglevant','The Young Levant','Lebanese Youth Blog','http://younglevant.wordpress.com/','YL',NULL,'http://younglevant.wordpress.com/feed/','politics',158),
	('ziadmajed','Ziad Majed','Pessimism of the intellect, Optimism of the will...','http://ziadmajed.blogspot.com/','Ziad Majed','ziadmajed','http://ziadmajed.blogspot.com/feeds/posts/default','politics',159),
	('shezshe','ShezShe','In Beirut and Everywhere','http://shezshe.net/','SheShe','shezshe','http://shezshe.net/rss','fashion, photography',160),
	('fromagesandfridays','Fromages & Fridays','A blog about my sometimes awful, oftentimes wonderful, always enjoyable experiences with food','http://fromagesandfridays.com','Maia Bulbul','maiabulbul','http://fromagesandfridays.com/feed/','food',161),
	('nadsreviews','Nad\'s Reviews','Nad\'s Reviews specializes in TV reviews as well as films and restaurants','http://www.nadsreviews.com/','Nad','NadsReviews','http://www.nadsreviews.com/feeds/posts/default?alt=rss','society, tv, culture',162),
	('carmelandvanilla','Carmel + Vanilla','The Fashion Blog','http://carmelandvanilla.com/','Lara Bechalany','LaraBechalany','http://carmelandvanilla.com/feed/','fashion',163);

/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
