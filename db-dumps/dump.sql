-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 10. Jun 2020 um 18:29
-- Server-Version: 5.7.26
-- PHP-Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `hash_magazine`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address`) VALUES
(17, 12, 'Main Street 23, 2348 Perth, Western Australia'),
(18, 11, 'Hillside 12, 1022 Sydney, New South Whales');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `crdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'creation date',
  `user_id` int(11) NOT NULL,
  `products` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Serialization or ordered products',
  `delivery_address_id` int(11) NOT NULL,
  `invoice_address_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` enum('open','in progress','in delivery','storno','delivered') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`id`, `crdate`, `user_id`, `products`, `delivery_address_id`, `invoice_address_id`, `payment_id`, `status`) VALUES
(19, '2020-06-10 12:49:32', 12, '[{\"id\":4,\"name\":\"Magazin #2\",\"description\":\"It\'s shown off to perfection on Pergraphica, a design paper that gives everyone an excellent reproduction of images and also boasts an extraordinary look & feel.\",\"full_description\":\"Photography generally plays only a minor role in a graphic design magazine like hash magazine, so putting together this issue was all the more special. And because photography takes so many different forms, our section is particularly diverse. We present eclectic arrangements from New York, beautiful but disturbing aerial shots of Spain, a report on the endangered paradise of Florida, wonderful food photography and much more. Come with us on a journey of discovery around the world, one where you\\u00b4ll find not only fascinating images but also lots of excellent design.\",\"price\":15,\"stock\":18,\"images\":[\"uploads\\/1590431091_Magazin_Layout_Mag2.svg\"],\"quantity\":2}]', 17, 17, 6, 'in progress'),
(20, '2020-06-10 12:52:57', 11, '[{\"id\":6,\"name\":\"Magazin #4\",\"description\":\"From graphic-design murals for sports facilities and orientation systems for schools, to children\'s book illustrations, educational materials and visual identities.\",\"full_description\":\"In the hash mag section there is much to explore: from graphic-design murals for sports facilities and orientation systems for schools, to wonderful children\\u00b4s book illustrations, educational materials and visual identities.\\r\\n\\r\\nIn the Showroom section we present the work of Argentinean designer Mario Eskenazi and the Czech studio Marvil. Sigrid Calon shows how to combine patterns and strong colours in fascinating spatial concepts while at lamatilde in Turin, we drool at mouthwatering catering concepts. And last, but not least, we bring you Studio Metric who were given the honour of illustrating Norway\\u00b4s new banknotes.\",\"price\":15,\"stock\":20,\"images\":[\"uploads\\/1590249883_Magazin_Layout_Mag4.svg\"],\"quantity\":1},{\"id\":10,\"name\":\"Magazin #8\",\"description\":\"Right on the contrary! Such design magazines strive to offer more and more quality content in order to keep their audience inspired, entertained, and informed.\",\"full_description\":\"Moreover, Communication Arts magazine has a strong digital presence with its website which is updated daily. You can enjoy a lot of free features, as well as premium content to which you can gain access via a paid subscription. The premium content includes hundreds of insightful articles, thousands of images and videos, as well as profiles of creative firms and individuals. Loved by many, Communication Arts has been around since 1959 covering everything and anything about visual communications. The great news is you can subscribe to Communication Arts regardless of your location on the globe. You can opt for print and digital issues, or digital issues only (which will cost you less).\",\"price\":15,\"stock\":5,\"images\":[\"uploads\\/1591787700_1590249663_Magazin_Layout_Mag8.svg\"],\"quantity\":1},{\"id\":8,\"name\":\"Magazin #6\",\"description\":\"Featuring an expressive motif by Spanish illustrator Agn\\u00e9s and a fire-red Chromolux card, the cover of hash mag #6 will inject life into the grey days of winter. \",\"full_description\":\"While many established magazines are suffering a drop in sales, customer magazines are ever more popular. They continue to be a wonderful communication tool for transporting values and raising brand allegiance. It\'s a strategy that works, thanks also to the high level of creativity demonstrated in the design of these magazines. In our hash mag section we present a selection of notable customer magazines. From big brands that impress with courage and innovation, to the small local bookstore which wins over customers with its passion and good content, customer magazines are a great playground for graphic designers.\",\"price\":15,\"stock\":18,\"images\":[\"uploads\\/1590249663_Magazin_Layout_Mag8.svg\"],\"quantity\":1}]', 18, 18, 7, 'in delivery'),
(21, '2020-06-10 12:53:26', 11, '[{\"id\":9,\"name\":\"Magazin #7\",\"description\":\"In this issue we visit Chao in Hong Kong. For her being a designer is a dream come true. She successfully combines Asian elegance with Western clarity. \",\"full_description\":\"Richard Vijgen from the Netherlands uses Big Data to visualise through design and research the stories that lie behind the data. VM& Estudio Gr\\u00e1fico fuse Peruvian influences with klassical graphic design and Yulia Popova from Berlin designs with great energy and a deep love of typography. Semiotik Design from Greece merge minimalist aesthetics with strong concepts and last, but not least we present the powerful illustrations of Agn\\u00e9s Ricart from Spain, a young creative who is also responsible for the cover of this issue. \\r\\nIn our hash mag section we take a closer look at various customer magazines and show how different they can be. From classical and refined to edgy and colourful \\u2013 anything goes and big brands prove just as innovative as small entrepreneurs.\",\"price\":15,\"stock\":20,\"images\":[\"uploads\\/1590249786_Magazin_Layout_Mag7.svg\"],\"quantity\":5}]', 18, 18, 7, 'in progress');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ccv` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='keine realistische Payments Tabelle!!';

--
-- Daten für Tabelle `payments`
--

INSERT INTO `payments` (`id`, `name`, `number`, `expires`, `ccv`, `user_id`) VALUES
(6, 'Admin Doe', '5622 2290 0091 1232', '0322', 123, 12),
(7, 'Sam Doe', '1930 1009 1231 1192', '0525', 789, 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `images` text COLLATE utf8_unicode_ci,
  `full_description` text COLLATE utf8_unicode_ci,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `images`, `full_description`, `is_deleted`) VALUES
(3, 'Magazin #1', 'Kate K. designed some of the most usable fonts. For her, every project must have its own signature. All this and more awaits you in the hash section.', 15, 20, 'uploads/1590249872_Magazin_Layout_1.svg', 'In this new issue of hash mag, our theme is »sustainability«. We present lots of ideas and concepts that offer a sensible way of saving resources. And indeed the cover of hash mag 05.20 has been produced according to the Blue Angel environmental standard. Designed by studio B.O.B. the motif interprets this theme with a good dose of black humour, and the fold-out cover shows that eco does not have to be synonymous with boring.', 0),
(4, 'Magazin #2', 'It\'s shown off to perfection on Pergraphica, a design paper that gives everyone an excellent reproduction of images and also boasts an extraordinary look & feel.', 15, 18, 'uploads/1590431091_Magazin_Layout_Mag2.svg', 'Photography generally plays only a minor role in a graphic design magazine like hash magazine, so putting together this issue was all the more special. And because photography takes so many different forms, our section is particularly diverse. We present eclectic arrangements from New York, beautiful but disturbing aerial shots of Spain, a report on the endangered paradise of Florida, wonderful food photography and much more. Come with us on a journey of discovery around the world, one where you´ll find not only fascinating images but also lots of excellent design.', 0),
(5, 'Magazin #3', 'The cover of our #3 issue is the result of a fascinating cooperation – it combines moving type with sophisticated printing technology. All with the highest quality.', 15, 25, 'uploads/1590249807_Magazin_Layout_Mag3.svg', 'What does the future hold for typographic design? Our #3 issue ventures a few answers. In the hash mag section, we present classic type design and also feature a range of projects that show how typography can address political and social problems. The motif came about in a cooperation with Studio Mut and other creatives: Think Work Observe made available the typeface Kunst Grotesk as a pre-release, and Kiel Danger Lorem developed a program that can be used to generate moving type. Using these components Studio Mut created a motif that draws on software and hardware – digitally generated type skilfully combined with sophisticated print technology.', 0),
(6, 'Magazin #4', 'From graphic-design murals for sports facilities and orientation systems for schools, to children\'s book illustrations, educational materials and visual identities.', 15, 20, 'uploads/1590249883_Magazin_Layout_Mag4.svg', 'In the hash mag section there is much to explore: from graphic-design murals for sports facilities and orientation systems for schools, to wonderful children´s book illustrations, educational materials and visual identities.\r\n\r\nIn the Showroom section we present the work of Argentinean designer Mario Eskenazi and the Czech studio Marvil. Sigrid Calon shows how to combine patterns and strong colours in fascinating spatial concepts while at lamatilde in Turin, we drool at mouthwatering catering concepts. And last, but not least, we bring you Studio Metric who were given the honour of illustrating Norway´s new banknotes.', 0),
(7, 'Magazin #5', 'In the showroom of this issue, we present the elegant appearances of Cansu from London, as well as the colorful and powerful designs by Valeria Cra from Italy. ', 15, 25, 'uploads/1590249818_Magazin_Layout_Mag5.svg', 'To gather inspiration for the cover motif of this issue, Janina Engel delved into the world of bars and put down her observations on paper, in the form of charming doodles. In our hash mag theme on »bars & drinks« we serve up some wonderful interior design concepts and visual identities to raise the spirits. Whether it\'s a pub in Munich, a stylish bar in Sydney, a devilish vermouth from Mallorca or a premium sake from Japan, the projects in our hash mag showcase the spectrum of design in hospitality and drinks. Good design, precise communication and a promise of a good time – what can be better than that?', 0),
(8, 'Magazin #6', 'Featuring an expressive motif by Spanish illustrator Agnés and a fire-red Chromolux card, the cover of hash mag #6 will inject life into the grey days of winter. ', 15, 18, 'uploads/1590249663_Magazin_Layout_Mag8.svg', 'While many established magazines are suffering a drop in sales, customer magazines are ever more popular. They continue to be a wonderful communication tool for transporting values and raising brand allegiance. It\'s a strategy that works, thanks also to the high level of creativity demonstrated in the design of these magazines. In our hash mag section we present a selection of notable customer magazines. From big brands that impress with courage and innovation, to the small local bookstore which wins over customers with its passion and good content, customer magazines are a great playground for graphic designers.', 0),
(9, 'Magazin #7', 'In this issue we visit Chao in Hong Kong. For her being a designer is a dream come true. She successfully combines Asian elegance with Western clarity. ', 15, 20, 'uploads/1590249786_Magazin_Layout_Mag7.svg', 'Richard Vijgen from the Netherlands uses Big Data to visualise through design and research the stories that lie behind the data. VM& Estudio Gráfico fuse Peruvian influences with klassical graphic design and Yulia Popova from Berlin designs with great energy and a deep love of typography. Semiotik Design from Greece merge minimalist aesthetics with strong concepts and last, but not least we present the powerful illustrations of Agnés Ricart from Spain, a young creative who is also responsible for the cover of this issue. \r\nIn our hash mag section we take a closer look at various customer magazines and show how different they can be. From classical and refined to edgy and colourful – anything goes and big brands prove just as innovative as small entrepreneurs.', 0),
(10, 'Magazin #8', 'Right on the contrary! Such design magazines strive to offer more and more quality content in order to keep their audience inspired, entertained, and informed.', 15, 5, 'uploads/1591787700_1590249663_Magazin_Layout_Mag8.svg', 'Moreover, Communication Arts magazine has a strong digital presence with its website which is updated daily. You can enjoy a lot of free features, as well as premium content to which you can gain access via a paid subscription. The premium content includes hundreds of insightful articles, thousands of images and videos, as well as profiles of creative firms and individuals. Loved by many, Communication Arts has been around since 1959 covering everything and anything about visual communications. The great news is you can subscribe to Communication Arts regardless of your location on the globe. You can opt for print and digital issues, or digital issues only (which will cost you less).', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '= username',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password Hash',
  `is_admin` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `is_admin`, `is_deleted`) VALUES
(8, 'John', 'Doe', 'john.doe@gmail.com', '$2y$10$1Mp2ifWHklOS5B5Ldw50Q.l4CFS2JEGwNpoue9X3hgalJil0Yu/wi', 1, 1),
(11, 'Sam', 'Doe', 'sam.doe@gmail.com', '$2y$10$SrdZ5E0Vg5kFoHaNIHqjuOqBW9pb1k8i0LPplw1.vxSaLHdS0GSWK', 0, NULL),
(12, 'Admin', 'Doe', 'admin.doe@gmail.com', '$2y$10$nydDWTBrBU1Fl4WJZWgS/ebdHBxlzaGXggOztNJYNqzlPl/ZRfy0C', 1, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
