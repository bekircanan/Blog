-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 31 oct. 2024 à 13:46
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bolg`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `contenu` mediumtext NOT NULL,
  `date_pub` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `fk_article` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `contenu`, `date_pub`, `titre`, `id_user`) VALUES
(10, 'Si tu es ici, c’est probablement que, comme moi, tu as plongé dans l’univers complètement déjanté et fascinant de JoJo\'s Bizarre Adventure. Cette série, créée par Hirohiko Araki, est bien plus qu’un simple anime. C’est une véritable odyssée qui mélange action, humour, et des concepts aussi absurdes que brillants. Personnellement, je suis tombé amoureux de JoJo dès le premier arc, mais chaque partie a su me marquer d’une façon unique.<br />\r\n<br />\r\nPartie 1 – Phantom Blood<br />\r\nJe vais être honnête, la première partie, Phantom Blood, m’a pris un peu de temps à m’accrocher. Jonathan Joestar est un protagoniste classique, presque trop parfait à mon goût. Mais c’est surtout l’antagoniste, Dio Brando, qui a tout changé. Dio, avec son charisme malsain et sa soif de pouvoir, est tout simplement inoubliable. C’est lui qui donne tout le sel à cette partie. L\'affrontement final entre Jonathan et Dio reste gravé dans ma mémoire, comme un des moments les plus dramatiques et intenses.<br />\r\n<br />\r\nPartie 2 – Battle Tendency<br />\r\nAvec Battle Tendency, je me suis dit : \"Ok, là on parle !\" Joseph Joestar est l’opposé total de Jonathan : plus rusé, plus sarcastique, et tellement plus fun ! Cette partie a un rythme fou, avec des combats beaucoup plus stratégiques et une montée en puissance palpable. Les Hamon étaient déjà cool, mais ce sont les Hommes du Pilier, surtout Kars, qui m’ont vraiment scotché. Joseph et son cerveau toujours en ébullition, sa façon de se sortir de situations impossibles, c’était un régal à suivre.<br />\r\n<br />\r\nPartie 3 – Stardust Crusaders<br />\r\nEt là, je dois dire… c’était l’ascension. L’apparition des Stands a tout changé. Jotaro Kujo et son \"ORA ORA ORA\" avec Star Platinum, c’était tout simplement épique. C’est à partir de ce moment que JoJo est devenu une obsession pour moi. Chaque combat dans Stardust Crusaders est une bataille de stratégie, et non de simple force brute. Sans parler du voyage de l’équipe à travers le monde, avec des affrontements contre des adversaires toujours plus excentriques et redoutables. Le duel final contre Dio, cette course contre la montre, ce ZA WARUDO, c’est tout simplement iconique.<br />\r\n<br />\r\nPartie 4 – Diamond is Unbreakable<br />\r\nQuand je suis arrivé à Diamond is Unbreakable, j’ai été surpris par le changement de ton. On passe d’un road trip mondial à une ambiance plus tranquille, presque \"slices of life\", dans la petite ville de Morioh. Mais ne te méprends pas, cette partie est un chef-d\'œuvre à sa manière. J\'ai adoré Josuke, un Joestar plus \"cool\", plus proche de nous. Et puis Kira Yoshikage… Quel méchant fascinant ! Sa normalité apparente rend ses actes encore plus terrifiants. L’atmosphère étrange et le mystère constant qui entourent Morioh rendent cette partie addictive.<br />\r\n<br />\r\nPartie 5 – Golden Wind<br />\r\nGolden Wind est tout simplement une œuvre d’art. Giorno Giovanna et son rêve de devenir le \"gangstar\" ultime m’ont totalement captivé. Ce que j’adore dans cette partie, c’est l’évolution des personnages, surtout celle de Bucciarati, que je considère comme l’un des meilleurs leaders de la série. Les combats de Golden Wind sont parmi les plus créatifs et intenses que j’ai vus, avec des Stands qui défient toute logique (coucou, King Crimson). L’intrigue est sombre, violente, mais empreinte d’un sentiment d’espoir.<br />\r\n<br />\r\nPartie 6 – Stone Ocean<br />\r\nJotaro revient, mais cette fois, c’est sa fille, Jolyne, qui prend le devant de la scène. Stone Ocean a ce petit quelque chose de spécial, peut-être parce que c’est la première fois qu’on suit une protagoniste féminine dans JoJo. Jolyne est incroyable, forte, tenace, et ses batailles en prison sont aussi tendues que captivantes. Le thème de la destinée est omniprésent dans cette partie, et le final est juste… déroutant. Sans spoiler, disons simplement que la fin m’a laissé sans voix, bouleversé par le courage des personnages face à une conclusion inévitable.<br />\r\n<br />\r\nPourquoi JoJo’s Bizarre Adventure est si spécial<br />\r\nPour moi, ce qui rend JoJo unique, c’est cette capacité à se réinventer constamment tout en gardant une identité forte. Chaque partie a son propre ton, son propre style artistique, et pourtant, l’héritage Joestar reste. Ce que j’aime aussi, c’est cette fusion incroyable de références culturelles, que ce soit à la musique, à l’histoire, ou même à la mode. Chaque épisode est un véritable régal visuel et auditif.<br />\r\n<br />\r\nJoJo’s Bizarre Adventure, c’est plus qu’un anime ou un manga. C’est une expérience. C’est de l’art. Et c’est, sans aucun doute, une série qui continuera à nous étonner pour les années à venir. Comme un fan dévoué, je suis là, prêt pour la suite des aventures, car dans l’univers de JoJo, tout est possible.<br />\r\n<br />\r\n\"Yare Yare Daze…\"', '2024-07-10 05:56:27', 'JoJo’s Bizarre Adventure : Mon Avis sur une Saga Légendaire', 14),
(11, 'Je vais être direct : Fairy Tail est probablement l’un des pires shonen que j’ai eu le malheur de regarder. Sérieusement, si vous cherchez une histoire avec une intrigue solide, des personnages bien développés et des combats qui ne se résument pas à du \"pouvoir de l’amitié\", passez votre chemin. Dès les premiers épisodes, j’avais un mauvais pressentiment, et croyez-moi, ça ne fait qu’empirer au fur et à mesure que l’histoire avance.<br />\r\n<br />\r\nL’Intrigue ? Quelle Intrigue ?<br />\r\nCe qui m’a immédiatement frappé, c’est à quel point l’intrigue de Fairy Tail est inexistante. On a une guilde de mages qui, soi-disant, part en mission pour sauver le monde, mais en réalité, c’est juste une excuse pour enchaîner des arcs répétitifs sans véritable progression. Chaque arc suit le même schéma : un méchant apparaît, les héros se battent, ils perdent, et… surprise, ils gagnent grâce à une explosion soudaine de sentiments. Il n\'y a jamais de véritable enjeu, parce que peu importe la situation, on sait toujours que le pouvoir de l\'amitié les sauvera.<br />\r\n<br />\r\nEt parlons de ces \"méchants\". Ils sont si prévisibles. Soit ils se repentent à la fin et rejoignent les gentils, soit ils sont balayés comme s\'ils n\'avaient jamais existé. Aucune menace ne semble durable, et ça rend les combats incroyablement fades.<br />\r\n<br />\r\nLe \"Pouvoir de l\'Amitié\" ou Comment Tuer Tout Suspense<br />\r\nJe comprends que l’amitié est un thème central dans les shonen, mais Fairy Tail pousse le concept au ridicule. Chaque combat, et je dis bien chaque combat, se termine de la même manière : les héros sont sur le point de perdre, mais grâce à un flashback de cinq secondes sur un souvenir joyeux ou une déclaration d’amitié dégoulinante, ils trouvent la force de renverser la situation. C’est devenu tellement prévisible que dès qu’un combat commence, tu sais déjà comment ça va se terminer. C’est ennuyeux et sans intérêt. Comment peux-tu te sentir investi quand tu sais que les personnages ne risquent jamais rien ?<br />\r\n<br />\r\nDes Personnages Mal Développés et Stéréotypés<br />\r\nEn parlant des personnages, c’est là que Fairy Tail tombe encore plus bas. Natsu, le héros principal, est l\'archétype du protagoniste shonen impulsif et débile. Il fonce dans le tas, résout tout par la violence, et bien sûr, crie \"Je vais protéger mes amis !\" à tout bout de champ. Ce qui est frustrant, c’est qu’il n’évolue jamais vraiment. Il reste le même du début à la fin, sans réel développement personnel.<br />\r\n<br />\r\nEt Lucy ? Je ne sais même pas par où commencer. Elle est supposée être un des personnages principaux, mais elle est constamment réduite à un rôle de demoiselle en détresse. Sa puissance est ridicule, et elle est principalement là pour du fanservice. Et oui, le fanservice… c\'est un autre problème énorme de Fairy Tail. C\'est comme si chaque scène impliquant des femmes était conçue pour plaire aux amateurs de ce genre de contenu. Les personnages féminins sont sous-développés, hypersexualisés, et souvent inutiles dans les combats.<br />\r\n<br />\r\nGray ? Encore un stéréotype ambulant, le rival \"cool\" qui aime se déshabiller pour aucune raison valable. Erza ? Certes, elle est puissante, mais elle tombe dans le même schéma que les autres : toujours plus forte par un miracle sorti de nulle part, et elle aussi se fait voler la vedette par le scénario centré sur Natsu et ses amis.<br />\r\n<br />\r\nUn Univers Plein de Potentiel… Gâché<br />\r\nLe monde de Fairy Tail avait pourtant du potentiel. Une guilde de mages avec des pouvoirs variés dans un monde rempli de magie ? L’idée est intéressante, mais elle est incroyablement mal exploitée. Les mages de la guilde ne semblent jamais atteindre leur plein potentiel, et leurs pouvoirs finissent par être ridicules ou surpuissants sans raison. La magie, qui pourrait être un élément stratégique et complexe, devient juste un gadget pour créer des explosions colorées à l’écran.<br />\r\n<br />\r\nSans oublier que chaque fois qu\'un personnage obtient un pouvoir impressionnant ou une nouvelle forme de magie, cela devient immédiatement obsolète dès que l’arc suivant commence. Pourquoi prendre la peine de donner un développement aux pouvoirs si tout est réinitialisé à chaque arc ?<br />\r\n<br />\r\nLe Fanservice à l’Extrême<br />\r\nIl faut aussi parler du fanservice. Fairy Tail ne peut pas passer cinq minutes sans trouver un moyen d’exposer une héroïne dans une position suggestive ou de faire une blague douteuse sur le corps de l’un des personnages. Cela devient lassant, surtout quand tu espères une série qui se concentre sur l’action ou l’intrigue. Le fanservice n\'est pas juste occasionnel dans Fairy Tail, il est carrément omniprésent, au point que cela distrait de l’histoire (déjà mince) et des combats.<br />\r\n<br />\r\nEn Conclusion<br />\r\nJe sais que Fairy Tail a beaucoup de fans, et je peux comprendre que certaines personnes apprécient l’aspect \"feel-good\" et la camaraderie entre les personnages. Mais si tu es comme moi, et que tu recherches une série avec une véritable intrigue, des combats avec du suspense, et des personnages qui évoluent au fil du temps, Fairy Tail est une énorme déception.<br />\r\n<br />\r\nC’est une série qui aurait pu être tellement plus, mais qui se contente de suivre les pires clichés du shonen sans jamais vraiment innover. Si tu veux du divertissement sans réfléchir, pourquoi pas. Mais pour tout le reste, il y a bien mieux ailleurs.', '2024-09-21 08:23:21', 'Fairy Tail : L\'Exemple Parfait de ce QUI NE VA PAS avec les Shonen', 15),
(12, 'Unordinary est une série qui, sous son apparence de récit de super-héros, offre une véritable réflexion sur la société et l’injustice. L’histoire se déroule dans un monde où ceux qui possèdent des pouvoirs sont socialement supérieurs, et le protagoniste, John, remet en question cette hiérarchie de manière brutale et parfois choquante. J’ai adoré la façon dont le webtoon traite des sujets comme le harcèlement, l’abus de pouvoir et les attentes sociales. Les personnages sont bien développés, en particulier John, dont la descente dans la violence est à la fois déchirante et fascinante. Mon seul bémol est que certaines situations peuvent devenir répétitives, avec des conflits qui semblent parfois tourner en rond. Malgré cela, Unordinary reste une lecture captivante et offre un regard unique sur le genre super-héroïque.', '2024-04-25 09:21:36', '\"Tower of God\" – Un Univers Complexe et Captivant', 13),
(13, 'Sweet Home m’a immédiatement plongé dans son ambiance sombre et oppressante. Ce webtoon d’horreur se distingue par son approche psychologique, où les monstres sont souvent des métaphores des angoisses des personnages. L’histoire suit Hyun Cha, un jeune homme isolé et déprimé, qui se retrouve coincé dans un immeuble rempli de monstres. Ce que j’ai trouvé brillant, c’est l’équilibre entre les moments de terreur et les moments plus émotionnels, où l’on découvre la profondeur des personnages. Les dessins contribuent parfaitement à cette atmosphère angoissante, mais j’aurais aimé que certains arcs secondaires soient un peu plus développés. Globalement, c’est un webtoon qui allie suspense, horreur et drame avec brio.<br />\r\n<br />\r\nLISEZ SWEET HOME', '2024-01-26 03:33:39', 'LE MEILLEUR WEBTOON D\'HORREUR', 13),
(14, 'Si vous cherchez un webtoon qui offre de l’action non-stop, The God of High School est fait pour vous. Les combats sont dynamiques, et les chorégraphies des scènes d’action sont parmi les meilleures que j’ai vues dans un webtoon. Cependant, après un certain temps, j’ai ressenti un manque de profondeur dans l’intrigue. L’histoire de ce tournoi de combat entre lycéens part d’une idée simple mais prometteuse, mais elle semble parfois s’éparpiller avec des ajouts de concepts surnaturels qui viennent compliquer les choses sans réelle explication. Les personnages sont cool, mais peu d’entre eux sont développés en dehors des scènes de combat. Malgré ces défauts, le webtoon reste très divertissant pour les amateurs d’action pure et de super-pouvoirs extravagants.', '2025-03-08 18:33:49', 'The God of High School est inccroyable', 13),
(15, 'Je viens de terminer A Silent Voice, et honnêtement, je ne peux pas arrêter de penser à cette histoire. Elle m\'a brisé le cœur d\'une manière que peu d’œuvres ont réussi à faire. Voir Shoya essayer de se racheter après tout ce qu\'il a fait à Shoko m’a bouleversé. La culpabilité qu\'il porte, cette solitude qu\'il s’impose... c’est tellement déchirant.<br />\r\n<br />\r\nMais ce qui m\'a le plus touché, c\'est la souffrance de Shoko. Elle a subi tant de choses, mais elle essaie toujours d’être forte, d’avancer. Ça m’a rendu tellement triste de voir à quel point elle se blâme pour tout. Chaque interaction, chaque regard qu\'elle lance m’a fait sentir son poids émotionnel. J\'avais envie de crier à l\'injustice de ce qu\'elle a traversé, de la manière dont les autres l\'ont traitée, et de voir combien elle souffre en silence.<br />\r\n<br />\r\nLa scène sur le balcon... J\'ai cru que mon cœur allait éclater. Le désespoir, le besoin de s\'échapper, c\'était insupportable à regarder. Mais ce qui est encore plus triste, c’est que ça reflète tellement la réalité pour certaines personnes, ce sentiment d’être un fardeau pour les autres.<br />\r\n<br />\r\nJe ressens un vide après avoir terminé A Silent Voice. C\'est une histoire de rédemption, oui, mais aussi de douleur, de regrets et de tristesse profonde.', '2024-07-18 15:36:21', 'J\'ai pleuré toutes les larmes de mon corps', 13),
(16, 'Sérieusement, Overlord m’a tellement frustré que j\'ai du mal à comprendre pourquoi cette série est si encensée ! Ainz est l’un des protagonistes les plus ennuyeux que j’aie jamais vus. Il est incroyablement surpuissant, ce qui tue complètement tout suspense ou enjeu. À quoi ça sert de suivre des combats ou des intrigues si Ainz gagne à chaque fois sans effort ? Il n’y a jamais de réel danger pour lui ou ses sbires, et ça devient répétitif et lassant.<br />\r\n<br />\r\nEt parlons du rythme... C\'est d\'une lenteur ! On passe la moitié des épisodes à suivre des personnages secondaires qui n’apportent rien à l’histoire, pendant que le protagoniste se balade comme un roi sans jamais être véritablement challengé. Les intrigues politiques, c’est bien quand c’est bien fait, mais ici, c’est tellement confus et inutile qu’on finit par décrocher complètement.<br />\r\n<br />\r\nFranchement, où est le développement des personnages ? Ainz n\'évolue jamais, il est juste là à accumuler du pouvoir et à jouer les \"méchants intelligents\" sans âme. C’est frustrant de voir une série avec un concept aussi prometteur gâchée par une écriture paresseuse et un manque total de tension.', '2025-05-09 05:30:36', 'overlord c\'est trop nul', 15),
(17, 'Salut c\'est Ninho, swipe up pour voir mon nouvel album !', '2025-02-27 18:25:39', 'Salut c\'est Ninho swipe up', 17),
(18, 'En tant que fan de super-héros, My Hero Academia est un régal. L’animation est superbe, et le développement des personnages, surtout celui de Deku, est touchant. Chaque arc présente des défis uniques, et j’adore la manière dont l\'anime traite des enjeux moraux. Les combats sont épiques, mais c’est vraiment la croissance des personnages qui m’a accroché.', '2025-07-18 10:49:22', 'L\'Éveil des Super-héros', 17),
(19, 'L’animation de Demon Slayer est tout simplement à couper le souffle. Chaque combat est une explosion de couleurs et d’intensité. J’ai adoré suivre le parcours de Tanjiro, et la relation qu’il entretient avec sa sœur Nezuko est profondément émouvante. C’est un anime qui, visuellement et émotionnellement, frappe fort à chaque épisode.', '2024-10-05 17:59:28', 'Un Festin Visuel', 14),
(20, 'Je suis un grand fan de Sword Art Online. L’idée de plonger dans un monde virtuel où chaque mort est définitive m’a tout de suite captivé. Bien que la série ait ses moments faibles, j’ai adoré les arcs où Kirito se bat pour sa survie et celle de ses amis. L’univers est riche, et chaque saison introduit de nouveaux concepts fascinants.', '2025-02-02 22:52:48', 'Une Aventure Numérique', 14),
(21, 'Your Lie in April m’a laissé en larmes. L’histoire est magnifique et déchirante, explorant les thèmes de la perte, du deuil et de l’espoir à travers la musique. Kousei et Kaori sont des personnages dont la relation évolue d’une manière poignante. L’anime est un voyage émotionnel que je recommande à tous ceux qui aiment les récits profonds et sensibles.', '2025-06-26 17:10:04', 'Une Mélodie Émouvante', 14),
(22, 'Je suis totalement bluffé par Attack on Titan. Chaque épisode est une montée d\'adrénaline, avec des rebondissements inattendus et des révélations choquantes. Eren, Armin, et Mikasa ont une évolution impressionnante, et l’exploration des thèmes de liberté, d’oppression et de sacrifice rend l’intrigue incroyablement profonde. C\'est l’un des meilleurs animes que j’ai vus, et l’intensité ne faiblit jamais.', '2024-05-29 05:00:24', ' Chef-d\'œuvre de Tension et de Drame', 14),
(23, 'Wow, cet épisode 1071 de One Piece, intitulé \"L\'Ultime Défi\", m’a complètement bluffé ! La tension était palpable tout au long de l’épisode, surtout lors du face-à-face final entre Luffy et Kaido. Les détails de l\'animation étaient à couper le souffle, chaque coup de poing semblait résonner et l\'impact des attaques était juste incroyable.<br />\r\n<br />\r\nLuffy, avec son nouveau pouvoir, a vraiment surpassé toutes mes attentes. C\'était tellement satisfaisant de le voir enfin prendre le dessus après tout ce qu’il a traversé. Les flashbacks avec ses amis et les souvenirs des batailles passées ajoutaient une profondeur émotive qui m\'a vraiment touché.<br />\r\n<br />\r\nEt je ne peux pas oublier l\'incroyable soutien de l\'équipage des Chapeaux de Paille ! Chacun d\'eux a eu sa part à jouer, et ça montre à quel point ils sont soudés. Cette camaraderie, c\'est vraiment ce qui fait de One Piece une série si spéciale. Je suis impatient de voir comment tout cela va évoluer dans les prochains épisodes. Encore un grand merci à Oda et à toute l’équipe pour ce chef-d\'œuvre ! ✨🏴‍☠️', '2025-07-05 03:42:11', 'Episode 1071 : \"L\'Ultime Défi\" – Une Explosion d\'Émotions !', 14),
(29, 'En tant que grand fan de shonen, \"Demon Slayer\" a été pour moi une claque visuelle dès le premier épisode. La qualité de l\'animation est juste incroyable, surtout lors des combats. Je pense que c\'est l\'un des rares animés où chaque épisode dépasse le précédent en termes de tension et d\'émotion. Tanjiro est un héros hyper attachant, et sa relation avec sa sœur Nezuko m\'a beaucoup touché. Vraiment, je ne peux que recommander cet animé à ceux qui recherchent une aventure intense et émotive.', '2024-10-28 11:30:00', 'Pourquoi j\'adore Demon Slayer', 14),
(30, 'Je dois avouer que j\'ai été sceptique en entendant que la dernière saison d\'\"Attack on Titan\" allait changer la donne. Mais après l\'avoir vue, je suis tout simplement époustouflé. Le développement du personnage d\'Eren est à la fois dérangeant et fascinant. J\'ai adoré comment la série mêle action et réflexion sur des sujets plus profonds comme la liberté et la guerre. Franchement, pour un fan de longue date comme moi, cette saison est une conclusion épique à une série qui n\'a cessé de me surprendre.', '2024-10-27 13:45:00', 'La saison finale d\'Attack on Titan', 13),
(31, 'Je n\'étais pas prêt pour l\'avalanche d\'émotions que \"Your Name\" allait déclencher chez moi. Sérieusement, ce film est juste magnifique. L\'animation est splendide, mais c\'est surtout l\'histoire qui m\'a accroché. Le lien entre Mitsuha et Taki est si fort et si bien construit qu\'on ne peut pas s\'empêcher de vouloir les voir ensemble. Chaque scène est un pur régal pour les yeux et le cœur. Franchement, c\'est l\'un des films d\'animé les plus touchants que j\'ai vus, et je le recommande à tous les romantiques dans l\'âme.', '2024-10-26 15:00:00', 'Your Name, un chef-d\'œuvre d\'émotions', 16),
(32, 'En tant que fan de super-héros et de shonen, \"My Hero Academia\" est pour moi un rêve devenu réalité. Voir Izuku, un garçon sans pouvoir, se battre pour devenir le meilleur héros, c\'est incroyablement inspirant. Ce que j\'aime particulièrement, c\'est que la série ne se contente pas d\'offrir de l\'action, mais traite aussi de thématiques profondes comme le courage et le sacrifice. Chaque personnage a son propre arc narratif et c\'est un régal de les voir évoluer. Bref, si vous aimez les histoires de super-héros avec une touche de profondeur, c\'est l\'animé qu\'il vous faut !', '2024-10-25 08:20:00', 'My Hero Academia, un shonen incontournable', 14),
(33, 'Naruto, c\'est l\'animé qui m\'a fait tomber amoureux des séries japonaises. Même après toutes ces années, je trouve que cette série reste incroyablement puissante. L\'évolution de Naruto, de l\'enfant rejeté à l\'héros de tout un village, m\'a vraiment marqué. Les combats, les moments d\'émotion, tout est tellement bien dosé. Ce qui me plaît aussi, c\'est la relation complexe entre Naruto et Sasuke. Elle donne une profondeur supplémentaire à l\'histoire. Franchement, pour moi, \"Naruto\" est plus qu\'un simple animé, c\'est une œuvre intemporelle.', '2024-10-24 06:00:00', 'Naruto, l\'animé qui m\'a tout appris', 13);

-- --------------------------------------------------------

--
-- Structure de la table `article_categorie`
--

DROP TABLE IF EXISTS `article_categorie`;
CREATE TABLE IF NOT EXISTS `article_categorie` (
  `id_categorie` int NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id_categorie`,`id_article`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`) VALUES
(11, 'Kodomo'),
(12, 'Shonen'),
(13, 'Shojo'),
(14, 'Seinen'),
(15, 'Josei'),
(16, 'Webtoon'),
(17, 'Manga'),
(18, 'Manhwa'),
(19, 'Manhua'),
(21, 'SPOILER'),
(22, 'Action'),
(23, 'Horreur'),
(24, 'Comédie'),
(25, 'Drame'),
(26, 'Science fiction'),
(27, 'Policier'),
(28, 'Aventure'),
(29, 'Fantastique'),
(30, 'Sport'),
(31, 'Isekai'),
(32, 'Slice of life');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_com` int NOT NULL AUTO_INCREMENT,
  `message` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id_com`),
  KEY `fk1_commentaire` (`id_user`),
  KEY `fk2_commentaire` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id_article` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_article`,`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_article`, `id_user`) VALUES
(12, 13),
(13, 13);

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id_token` int NOT NULL AUTO_INCREMENT,
  `nom_token` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expire` datetime NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_token`),
  UNIQUE KEY `uni_token` (`nom_token`),
  KEY `fk_token` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(25) NOT NULL,
  `mdp` varchar(61) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `email`, `mdp`, `pseudo`, `admin`) VALUES
(11, 'admin@localhost.fr', '$2y$10$CgH/K4du0o9x6WaC4sbWHea.xwfJ7j0bRJhfOUYwOGVH6xkh8NvwS', 'admin', 1),
(13, 'isira213213@gmail.com', '$2y$10$v3EMsXFQpJNvmpLDTpleFOzvsekbSeOVO8.W8wiVOY45Y7IAORiFm', 'isira', 0),
(14, 'hazazell376@gmail.com', '$2y$10$lJDbBtYM/akMMfSEjvcAdeyFqoLHB7soR.wR/dCwDOQQGNnVI1EzW', 'hazazell', 0),
(15, 'pinguin@hotmail.com', '$2y$10$h5qo.mopcxWfMZCE6piBcOydR2ulxCvt8HBmwfAG3AuOCbFNAy9S6', 'HATER_3982', 0),
(16, 'amadis.senelet@etu.univ-l', '$2y$10$D7CpZF1WthmyP29.iS.5rejWe5EwUNowo11wy7QHG4AV9q.JQ.nhK', 'Amadis', 0),
(17, 'ninho@gmail.com', '$2y$10$rDiGiU8wr9HP0gsy8L5hou/rAH4YVMAib/Kw/lh4RfLDoWIIBCHB2', 'Ninho', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `article_categorie`
--
ALTER TABLE `article_categorie`
  ADD CONSTRAINT `article_categorie_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_categorie_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk1_commentaire` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk2_commentaire` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE CASCADE;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE CASCADE;

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
