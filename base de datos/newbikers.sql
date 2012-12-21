-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.30-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema prueba
--

CREATE DATABASE IF NOT EXISTS prueba;
USE prueba;

--
-- Definition of table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE `carrito` (
  `idprod` int(10) unsigned NOT NULL,
  `numusu` int(10) unsigned NOT NULL,
  `unidades` int(10) unsigned NOT NULL,
  `precioprod` double DEFAULT NULL,
  `nombreproducto` varchar(45) NOT NULL,
  PRIMARY KEY (`idprod`,`numusu`),
  KEY `usua` (`numusu`),
  CONSTRAINT `numpro` FOREIGN KEY (`idprod`) REFERENCES `productos` (`id_producto`),
  CONSTRAINT `usua` FOREIGN KEY (`numusu`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carrito`
--

/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;


--
-- Definition of table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id_categoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `num_prod` int(10) unsigned NOT NULL,
  `ubicacion` int(10) unsigned NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `ubi` (`ubicacion`),
  CONSTRAINT `ubi` FOREIGN KEY (`ubicacion`) REFERENCES `ubicacion` (`id_ubicacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias`
--

/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id_categoria`,`nombre`,`num_prod`,`ubicacion`,`foto`) VALUES 
 (1,'Custom',3,1,'images/custom.jpg'),
 (2,'Sport',5,1,'images/sport.jpg'),
 (3,'Naked',5,1,'images/naked.jpg'),
 (4,'Touring',4,1,'images/touring.jpg'),
 (5,'Enduro',3,1,'images/enduro.jpg'),
 (6,'Textil',6,2,'images/textil.jpg'),
 (7,'Cascos',6,2,'images/cascos.jpg'),
 (8,'Accesorios Varios',6,2,'images/accesoriosvarios.jpg');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;


--
-- Definition of table `contiene`
--

DROP TABLE IF EXISTS `contiene`;
CREATE TABLE `contiene` (
  `pedido` int(10) unsigned NOT NULL,
  `producto` int(10) unsigned NOT NULL,
  `unidades` int(10) unsigned NOT NULL,
  `precio_unidades` double NOT NULL,
  PRIMARY KEY (`pedido`,`producto`),
  KEY `prod` (`producto`),
  CONSTRAINT `ped` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prod` FOREIGN KEY (`producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contiene`
--

/*!40000 ALTER TABLE `contiene` DISABLE KEYS */;
/*!40000 ALTER TABLE `contiene` ENABLE KEYS */;


--
-- Definition of table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id_pedido` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` varchar(10) NOT NULL,
  `importe_total` double NOT NULL,
  `cliente` int(10) unsigned NOT NULL,
  `fecha_hora_pedido` datetime NOT NULL,
  `fecha_hora_entrega` datetime NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `cli` (`cliente`),
  CONSTRAINT `cli` FOREIGN KEY (`cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pedidos`
--

/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;


--
-- Definition of table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id_producto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `p_descripcion` varchar(650) DEFAULT NULL,
  `amplia_descripcion` varchar(2000) DEFAULT NULL,
  `precio` double NOT NULL,
  `categoria` int(10) unsigned NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `cat` (`categoria`),
  CONSTRAINT `cat` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productos`
--

/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id_producto`,`nombre`,`p_descripcion`,`amplia_descripcion`,`precio`,`categoria`,`foto`) VALUES 
 (1,'Kawasaki VN900','La diferencia entre una customización y una custom de serie se reduce cada vez más con la VN900 Custom. Su duro estilo y funcionalidad demuestran que el diseño no va en detrimento de las prestaciones. Y la VN900 Custom es la mejor prueba.','Rompiendo con la línea más clásica de los cruiser americanos, la ofensiva japonesa se está polarizando y junto a modelos de aire más monumental, encontramos ejercicios de estilo que retoman un aire más cercano al chopper. La Vulcan 900 Custom evidencia esa tendencia. Su zaga es musculosa y masiva, calzada con un 180, mientras que el eje delantero luce una llanta de 21”, todo un clásico del custom más radical. Kawasaki hace especial hincapié en este aspecto, pues a pesar de que algunos fabricantes ofrecen modelos con esa medida de llanta, lo cierto es que ésta es la primera en aleación que se ofrece en un modelo de serie. El chasis de la VN 900 es de tipo Softail, con doble cuna en tubo de acero y un basculante con el amortiguador oculto, al estilo de las antiguas motos de chasis rígido. Las líneas de la carrocería son fluidas, casi rozando la morbidez, lo que contrasta con su parte delantera. Si la zaga resulta “gorda” y masiva, la delantera resulta algo más fina y está rematada con un manillar en doble T, que rompe la uniformidad del modelo.',8150,1,'images/kwvn900.jpg'),
 (2,'Harley Davidson - Super Glide Custom','Fuerza bruta, metal esculpido y cromo brillante...no hay duda de que ella inició el movimiento custom de fábrica.','Experimenta la aceleración y el par 123 Nm de este motor Twin Cam 96º montado sobre anclajes de goma, con acabado en polvo de plata y tapas cromadas. Velocímetro electrónico con odómetro montado sobre el depósito de combustible; odómetro con reloj horario; cuentakilómetros parcial ajustable a cero; intermitentes de emergencia integrados en los controles de los intermitentes.',15950,1,'images/harley.jpg'),
 (3,'Honda Shadow VT750','La Honda custom de estilo americano, de la categoría de 750cc, se ha ido labrando una sólida reputación desde hace mucho tiempo por su bonito estilo, su comodidad, sus prestaciones excitantes pero accesibles y su facilidad de control para los conductores de cualquier talla, y todo ello a un precio extraordinariamente razonable.','La Honda custom de estilo americano, de la categoría de 750cc, se ha ido labrando una sólida reputación desde hace mucho tiempo por su bonito estilo, su comodidad, sus prestaciones excitantes pero accesibles y su facilidad de control para los conductores de cualquier talla, y todo ello a un precio extraordinariamente razonable. Ni demasiado grandes ni demasiado pequeñas, la Shadow 750 y la Shadow Spirit proporcionan una amplia potencia y una fuerte aceleración, combinadas con el impactante tacto y sonido de un motor V-Twin de media cilindrada.\r\nUnas cifras de potencia monstruosas y una aceleración explosiva no son por lo general lo más importante para los motoristas de este segmento.\r\n\r\n	\r\n\r\nEn su lugar, estas custom clásicas se decantan más por ofrecer una postura cómoda y recostada para disfrutar los tranquilos placeres de la carretera abierta, sintiéndote a gusto y ofreciendo una bonita imagen mientras lo haces.Atractivas llantas de radios, cromadas en zinc, detenidas por un disco de freno delantero de 296 mm, con pinza de doble pistón, y un tambor trasero de 180 mm.\r\n\r\nNuevo radiador ultra estrecho, limpiamente integrado entre los tubos frontales descendentes del chasis. El sistema inmovilizador H.I.S.S. proporciona una eficaz prevención contra el robo en marcha. Extensa gama de accesorios opcionales.En 2004 Debuta la nueva Shadow 750. Sustituye la actual VT750C2 Shadow American Classic Edition y a la VT750DC Black Widow. Estilo Cruiser largo y bajo de ciudad con un asiento muy bajo, tipo silla de montar. El elegante velocímetro, montado en el depósito. Robusto motor bicilíndrico en V a 52° para ofrecer un par más fuerte de bajo a medio régimen. El carburador CV de 34 mm mejora el tacto del motor. El atractivo sistema de escape 2 en 1, acabado en cromo, incorpora tubos calientes catalizadores integrados para reducir las emisiones de escape.',9149,1,'images/hondashadow.jpg'),
 (4,'Yamaha YZF-R1','La YZF-R1 es una leyenda del mundo de las súper deportivas, una estrella unilitro que se ha convertido en un icono del motociclismo, la poderosa máquina ganadora del Mundial de Superbike, también conocida por ser un monumento al poder de la belleza. Las prestaciones de la R1 son electrizantes, pero lo que realmente asombra de esta motocicleta es su carácter manejable y la tecnología vanguardista de Yamaha, nacida en el circuito de competición, para que siempre estés en control y confiado.','Refrigeración líquida, 4 tiempos , DOHC, 4 válvulas, 4 cilindros en línea inclinados hacia adelante.    \r\n	\r\n\r\n*  Tecnología punta del circuito de carrera \r\n\r\n   	\r\n\r\n* 132 kW @ 12.500 rpm \r\n\r\n    	\r\n\r\n* Acelerador y Entrada de Aire controlados por chip Yamaha \r\n\r\n    	\r\n\r\n* Pinzas delanteras de 6 pistones con discos 310mm \r\n\r\n    	\r\n\r\n* Embrague deslizante antirrebote ',12999,2,'images/r1.jpg'),
 (5,'Suzuki GSXR 750 ','Con el motor 4T de 750 cc más potente, eficaz y limpio jamás fabricado por Suzuki. Con un nuevo chasis fundido en aleación de aluminio y una nueva y bella carrocería más aerodinámica. Su avanzado sistema de gestión de motor y de inyección electrónica con diferentes mapas seleccionables sobre la marcha, las suspensiones de alta calidad totalmente regulables y los frenos delanteros de anclaje radial, todo ello en un compacto conjunto, ofrecen las mejores prestaciones en circuito.','Con el motor 4T de 750 cc más potente, eficaz y limpio jamás fabricado por Suzuki. Con un nuevo chasis fundido en aleación de aluminio y una nueva y bella carrocería más aerodinámica. Su avanzado sistema de gestión de motor y de inyección electrónica con diferentes mapas seleccionables sobre la marcha, las suspensiones de alta calidad totalmente regulables y los frenos delanteros de anclaje radial, todo ello en un compacto conjunto, ofrecen las mejores prestaciones en circuito.',12599,2,'images/gsx.jpg'),
 (6,'Honda CBR1000RR ','La CBR1000RR Fireblade está bien consolidada como líder entre las motocicletas deportivas disponibles hoy en día en el Mercado, y ofrece las más altas prestaciones absolutas y la mayor facilidad de manejo – tanto en circuito como en carretera. Más ligera que la competencia, con una velocidad y agilidad inigualables, la Fireblade es la piedra de toque dentro del motociclismo que hace subir la adrenalina.','La nueva e impactante CBR600RR 2009 está preparada de nuevo para ampliar los límites en cuanto a estética y prestaciones. Combinando una extraordinaria velocidad en circuito con unas impecables maneras en carretera, la nueva máquina, increíblemente compacta y potente, permite perfeccionarse y superarse sobre su asiento a un rango aún más amplio de conductores. En 2009, la interesantísima introducción del C-ABS Electrónico pone a la CBR600RR en la vanguardia de la seguridad en motocicletas. \r\n\r\nEn el desarrollo del sistema, Honda ha tenido muy presente las características propias de los modelos deportivos, es decir, una corta distancia entre ejes, un alto centro de gravedad y una elevada relación potencia-peso. De esta manera se ha desarrollado el C-ABS Electrónico con la finalidad de asegurar el máximo nivel de prestaciones dinámicas, especialmente en agilidad, manejabilidad y estabilidad. Así, el peso extra que supone este sistema no afecta en absoluto la filosofía de deportividad de este modelo. Este nuevo sistema supone un extra de seguridad y confianza en situaciones de emergencia o de superficies deslizantes inesperadas, tanto en circuito como especialmente en carretera.\r\n\r\nEntre los cambios para 2009 está la revisión del ultra compacto motor de la CBR600RR, que ha incrementado su par para ofrecer aún más flexibilidad y finura de funcionamiento. Por otra parte, la CBR600RR mantiene su estilo minimalista y estilizado. Todos sus elementos responden a la misma filosofía de centralización de masas que convierten a este modelo en uno de los más manejables de su segmento.',16499,2,'images/cbr.jpg'),
 (7,'Kawasaki Ninja ZX-10R','Con la nueva Ninja ZX-10R adaptamos nuestra experiencia en circuito a la carretera. Con excelente respuesta para los pilotos de competición más exigentes, su rendimiento y manejabilidad permiten que los pilotos más experimentados le saquen el máximo provecho. Un inteligente sistema de encendido controla la tracción. El equilibrio perfecto.','Con la nueva Ninja ZX-10R adaptamos nuestra experiencia en circuito a la carretera. Con excelente respuesta para los pilotos de competición más exigentes, su rendimiento y manejabilidad permiten que los pilotos más experimentados le saquen el máximo provecho. Un inteligente sistema de encendido controla la tracción. El equilibrio perfecto.',14650,2,'images/ninja.jpg'),
 (8,'KTM 1190 RC8 R','Más potente y ligera que cualquier otra motocileta que pudiera autoconsiderarse como rival: 123 Nm de par motor, 170 CV a 10.250 rpm y un peso por debajo de los 200 kg con el depósito lleno.','Más potente y ligera que cualquier otra motocileta que pudiera autoconsiderarse como rival: 123 Nm de par motor, 170 CV a 10.250 rpm y un peso por debajo de los 200 kg con el depósito lleno.\r\n\r\nNo obstante, gracias a unas innovadoras soluciones y a un meticuloso trabajo de detalle, hemos conseguido una facilidad de pilotaje incomparable, en carretera y circuito, en cualquier situación de la vida real o en competición pura.',20999,2,'images/ktmrc8.jpg'),
 (9,'KTM 990 Super Duke R','La 990 Super Duke R tenía que ser la moto más picante fabricada nunca en serie. Para ello, los ingenieros de KTM dieron lo mejor de si mismos para desarrollar una “máquina” capaz de aprovechar hasta el último centímetro de legalidad en carretera abierta: horquilla WP de 48 mm totalmente ajustable, ultraligero subchasis monoplaza, chasis multitubular en cromo molibdeno de tan solo 9 kg de peso así como un amortiguador de dirección para bajar los tiempos aún más. Sin seguir pautas de ningún tipo.','La 990 Super Duke R tenía que ser la moto más picante fabricada nunca en serie. Para ello, los ingenieros de KTM dieron lo mejor de si mismos para desarrollar una “máquina” capaz de aprovechar hasta el último centímetro de legalidad en carretera abierta: horquilla WP de 48 mm totalmente ajustable, ultraligero subchasis monoplaza, chasis multitubular en cromo molibdeno de tan solo 9 kg de peso así como un amortiguador de dirección para bajar los tiempos aún más. Sin seguir pautas de ningún tipo.',14257,3,'images/ktmnaked.jpg'),
 (10,'Honda Hornet CB600F','Un estilo que atrae todas las miradas y unas excitantes prestaciones se unen en la Hornet CB600F como en ninguna otra moto que circule por las carreteras. Como indiscutible pionera entre las naked de tamaño medio y altas prestaciones, la Hornet CB600F ha marcado siempre la pauta en cuanto a imagen streetfighter y diversión de conducción.','Un estilo que atrae todas las miradas y unas excitantes prestaciones se unen en la Hornet CB600F como en ninguna otra moto que circule por las carreteras. Como indiscutible pionera entre las naked de tamaño medio y altas prestaciones, la Hornet CB600F ha marcado siempre la pauta en cuanto a imagen streetfighter y diversión de conducción.\r\n\r\n	\r\n\r\nMás esbelta, ligera, potente y fácil de llevar que ninguna otra moto de su categoría, la Hornet CB600F consigue sus explosivas prestaciones gracias al mismo motor compacto que permite a la fenomenal CBR600RR dominar en el circuito y en la calle, pero afinado para ofrecer una aceleración más fuerte a medio régimen y mantener así el alto nivel de excitantes sensaciones que la Hornet CB600F proporciona.\r\n\r\n	\r\n\r\nCuando se diseño esta excitante nueva generación de la famosa Hornet CB600F, su equipo de diseño decidió que solo la planta motriz de 600cc más nueva y más avanzada podía cubrir sus objetivos y ya que el motor de la CBR600RR 2007 también estaba en fase de desarrollo en ese momento, se eligió inmediatamente ese motor para cumplir los exigentes requisitos de la Hornet CB600F.\r\n\r\n	\r\n\r\nEl compacto tamaño y la ligereza del motor de la Hornet CB600F ayudan a centralizar mejor su masa para conseguir una manejabilidad más ágil y ligera. Así mismo, su avanzado sistema de inyección de gasolina se combina con otras características para asegurar unas prestaciones más suaves y de mayor respuesta, y una mayor aceleración más aguda, acompañadas con las bajas emisiones y consumo requeridos en los vehículos actuales.',8299,3,'images/cb600f.jpg'),
 (11,'Hyosung Comet GT250i','La Comet GT250i es una naked de pura raza. Esta motocicleta atrae admiradores, y su motor DOCH de 4 válvulas e inyeccción electrónica te despertará los sentidos.','La Comet GT 250i es una naked de pura raza. Esta motocicleta atrae admiradores, y su motor DOHC de 4 válvulas e inyección electrónica te despertará los sentidos.',2999,3,'images/comet.jpg'),
 (12,'Kawasaki Z1000','AGRESIVIDAD, POTENCIA, IMAGEN Y PRESTACIONES EN ESTADO PURO.','AGRESIVIDAD, POTENCIA, IMAGEN Y PRESTACIONES EN ESTADO PURO.',10775,3,'images/z1000.jpg'),
 (13,'Suzuki BKing','Una moto tan sorprendente que estableció una revolución en el diseño con una sola aparición en el Salón de Tokyo 2001. Ahora, el concepto se ha hecho realidad. Respaldando su emocionante imagen con unas prestaciones que cortan la respiración. Con refinamientos tecnológicos y estilo arrollador. Combinando personalidad con 1340 cc llenos de musculoso par y con el avanzado sistema de inyección de Suzuki, con selector de \"mapa de potencia\" de 2 posiciones. Envuelta en un avanzado chasis de aluminio, equipado con suspensiones de alta calidad y frenos de anclaje radial. Porque esta moto no es solo para admirarla, también es para conducirla.','Una moto tan sorprendente que estableció una revolución en el diseño con una sola aparición en el Salón de Tokyo 2001. Ahora, el concepto se ha hecho realidad. Respaldando su emocionante imagen con unas prestaciones que cortan la respiración. Con refinamientos tecnológicos y estilo arrollador. Combinando personalidad con 1340 cc llenos de musculoso par y con el avanzado sistema de inyección de Suzuki, con selector de \"mapa de potencia\" de 2 posiciones. Envuelta en un avanzado chasis de aluminio, equipado con suspensiones de alta calidad y frenos de anclaje radial. Porque esta moto no es solo para admirarla, también es para conducirla.',14699,3,'images/bking.jpg'),
 (14,'Honda Goldwing GL1800','Aclamada en todo el mundo como la ‘Reina de la Carretera’, la Goldwing, maravilla de la ingeniería, se ha ganado una envidiable reputación como máximo exponente del turismo de lujo sobre dos ruedas, con el cual se comparan todas las demás motos de turismo. Combinando una grandes prestaciones con un extraordinario confort y excepcional capacidad de carga, la majestuosa Goldwing brinda una completa y formidable experiencia de turismo de larga distancia que nunca queda desfasada.','Aclamada en todo el mundo como la ‘Reina de la Carretera’, la Goldwing, maravilla de la ingeniería, se ha ganado una envidiable reputación como máximo exponente del turismo de lujo sobre dos ruedas, con el cual se comparan todas las demás motos de turismo. Combinando una grandes prestaciones con un extraordinario confort y excepcional capacidad de carga, la majestuosa Goldwing brinda una completa y formidable experiencia de turismo de larga distancia que nunca queda desfasada. Todas sus excepcionales y abundantes características se suman para ofrecer una de las experiencias más impresionantes, placenteras y gratificantes sobre ruedas, ya sea atravesando la ciudad como todo el continente y aún más lejos.',34449,4,'images/goldwing.jpg'),
 (15,'Kawasaki 1400GTR','Hasta ahora las tourers tenían que sacrificar algún aspecto. Kawasaki no hace concesiones. Hemos cogido el motor de la poderosa ZZR1400, la \"hipersportsbike\" más potente del mundo, y lo hemos reajustado para hacer que la mega-sports tourer 1400GTR ofrezca el rendimiento que exigen los pilotos mas sport. Además, el inigualable bastidor monobloque de Kawasaki.','Hasta ahora las sport tourers tenían que sacrificar algún aspecto. Kawasaki no hace concesiones. Hemos cogido el motor de la poderosa ZZR1400, la \"hipersportsbike\" más potente del mundo, y lo hemos reajustado para hacer que la mega-sports tourer 1400GTR ofrezca el rendimiento que exigen los pilotos mas sport. Además, el inigualable bastidor monobloque de Kawasaki.',16999,4,'images/1400gtr.jpg'),
 (16,'BMW K 1300 GT','Gran Turismo, o en el caso de la BMW K 1300 GT simplemente una de las motocicletas más rápidas y cómodas. Abre una nueva era en las grandes distancias. Impresionan las cifras de esta motocicleta, su rendimiento a bajas velocidades, o en curvas muy cerradas. A velocidades bajas y medias, rango de velocidad en el que un conductor medio se mueve el 80 % del tiempo, el rendimiento es extraordinario que es donde verdaderamente importa.','Gran Turismo, o en el caso de la BMW K 1300 GT simplemente una de las motocicletas más rápidas y cómodas. Abre una nueva era en las grandes distancias. Impresionan las cifras de esta motocicleta, su rendimiento a bajas velocidades, o en curvas muy cerradas. A velocidades bajas y medias, rango de velocidad en el que un conductor medio se mueve el 80 % del tiempo, el rendimiento es extraordinario que es donde verdaderamente importa.	\r\n\r\nPuedes sentir al instante 135 Nm de sus 1293cc. La verdad es que esta cuatro cilindros sorprende con un consumo y emisiones bajos..\r\n	El éxito de las GT es debido a la suma de muchos detalles: la mejor ergonomía tanto en los mandos como de acompañante, protección aerodinámica y climatológica ejemplar, seguridad con el ABS de serie, y ASC opcional. Y una comodidad que permite viajes relajados. El chasis es de alta precisión y tiene un centro de gravedad bajo, a su vez el ESA II opcional adapta la presión de la suspensión con solo un botón.',19600,4,'images/bmw1300.jpg'),
 (17,'Yamaha FJR 1300AS','La FJR1300AS representa una revolución en la categoría sports touring. Posee todas las fortalezas de la premiada FJR1300A con el beneficio adicional de contar con YCC-S (Yamaha Chip Controlled – Shift), un sistema de cambios sin palanca de embrague que elimina la fatiga de los largos días sobre la carretera. Puedes cambiar de marcha a pie, de la manera habitual, o usando un pulsador en el puño izquierdo, sin necesidad de operar el embrague. La idea es sencilla – reducir las molestias y aumentar el placer de conducción.','La FJR1300AS representa una revolución en la categoría sports touring. Posee todas las fortalezas de la premiada FJR1300A con el beneficio adicional de contar con YCC-S (Yamaha Chip Controlled – Shift), un sistema de cambios sin palanca de embrague que elimina la fatiga de los largos días sobre la carretera. Puedes cambiar de marcha a pie, de la manera habitual, o usando un pulsador en el puño izquierdo, sin necesidad de operar el embrague. La idea es sencilla – reducir las molestias y aumentar el placer de conducción.',18799,4,'images/yamahafrj.jpg'),
 (18,'Suzuki DRZ400S','La DRZ400S, basada en la offroad DRZ400E, ofrece las aptitudes más camperas en el segmento de las trail deportivas, gracias a su avanzado motor DOHC 4T de 398 cc y refrigeración líquida y a su chasis compacto, ligero y ágil. Pero además la DRZ400S equipa un carburador Mikuni acorde con todas las normativas anti emisiones y un compacto tablero de instrumentos multifunción digital que, unidos a su gran manejabilidad, le otorgan el lado práctico para ser disfrutada en ciudad o carretera.','La DRZ400S, basada en la offroad DRZ400E, ofrece las aptitudes más camperas en el segmento de las trail deportivas, gracias a su avanzado motor DOHC 4T de 398 cc y refrigeración líquida y a su chasis compacto, ligero y ágil. Pero además la DRZ400S equipa un carburador Mikuni acorde con todas las normativas anti emisiones y un compacto tablero de instrumentos multifunción digital que, unidos a su gran manejabilidad, le otorgan el lado práctico para ser disfrutada en ciudad o carretera.',7000,5,'images/drz400.jpg'),
 (19,'Yamaha WR450F','No hay motos off-road tan trabajadas como las Yamaha WR de enduro. Y con su potencia fuera de serie y su avanzado chasis de aluminio, la WR450F es una de las más impresionantes motocicletas de E2 de la actualidad.','No hay motos off-road tan trabajadas como las Yamaha WR de enduro. Y con su potencia fuera de serie y su avanzado chasis de aluminio, la WR450F es una de las más impresionantes motocicletas de E2 de la actualidad.\r\n\r\nLa ambición por ganar es parte integral del ADN de cualquier Yamaha y, la mires por donde la mires, puedes ver que la WR450F es una genuina pura sangre. Su motor de 5 válvulas ofrece unos valores impresionantes de par motor a bajo y medio régimen para las mejores prestaciones off-road. Y el diseño internacionalmente ganador de su chasis de aluminio ha sido creado para enfrentarse a los peores terrenos.WR450F. Una seria rival.',8799,5,'images/wr450.jpg'),
 (20,'BMW R1600GS','Con este modelo, los ingenieros de BMW Motorrad se propusieron materializar su propio sueño de conducción todo terreno: una moto de 1.200 cm3 de dos cilindros opuestos, con 105 CV y 115 Nm y de 175 kg de peso en seco gracias a la construcción ligera y sin concesiones y a unos componentes de la más alta calidad.','Con este modelo, los ingenieros de BMW Motorrad se propusieron materializar su propio sueño de conducción todo terreno: una moto de 1.200 cm3 de dos cilindros opuestos, con 105 CV y 115 Nm y de 175 kg de peso en seco gracias a la construcción ligera y sin concesiones y a unos componentes de la más alta calidad.',16100,5,'images/bmw1200gs.jpg'),
 (21,'Chaqueta Stelvio 2.0 Touring','Chaqueta para viajes de larga distancia que soporta cualquier velocidad y condición meterorológica.','Chaqueta para viajes de larga distancia que soporta cualquier velocidad y condición meterorológica. Forro térmico de microfibra de quita y pon, y cuello de invierno. Cubierta exterior a prueba de viento, resistente a la abrasión más agresiva. Membrana transpirable e impermeable 100%. Bolsillos impermeables. Cremalleras ajustables de ventilación. Forro de malla hipoalergénico. Protección externa en los antebrazos y los codos. Multiajuste para asegurar que queda a medida. Todas las tiras de ajuste están escondidas o son internas para evitar problemas a altas velocidades. Los cordones de sujeción pueden ocultarse para evitar que cuelguen. Protectores internos Knox aprobados por la CE. Sutiles líneas negras reflectoras para garantizar la visibilidad.',299,6,'images/chaqueta.jpg'),
 (22,'Pantalones para lluvia','Para llevar sobre sus pantalones de piloto y mantenerle seco.','Para llevar sobre sus pantalones de piloto y mantenerle seco. Fabricados con nylon Oxford de máxima calidad. Acolchado fino de espuma en las rodillas. Bolsillo grande.',59,6,'images/pantalones.jpg'),
 (23,'Camiseta Manga Larga Térmica','Camiseta de invierno de manga larga que utiliza los más modernos tejidos de secado rápido antibacterianos para garantizar el máximo aislamiento en climas fríos. Transpirable al 100 % y diseñado para dejar salir la humedad.','Camiseta de invierno de manga larga que utiliza los más modernos tejidos de secado rápido antibacterianos para garantizar el máximo aislamiento en climas fríos. Transpirable al 100 % y diseñado para dejar salir la humedad.',42,6,'images/camiseta.jpg'),
 (24,'Botas Sport Tec 1','Funcionales botas de piel impermeables en negro con sutiles adornos en verde.','Funcionales botas de piel impermeables en negro con sutiles adornos en verde. Dos cremalleras de gran tamaño facilitan la tarea de ponérselas y quitárselas. Anchura de la caña regulable, forro transpirable y suela antideslizante.',125,6,'images/botas.jpg'),
 (25,'Guantes Deportivos Negros','Guantes deportivos Kawasaki de piel de vacuno.','Guantes deportivos Kawasaki de piel de vacuno. La combinación del confort con una alta protección; resistentes a la abrasión; sólida protección de los nudillos para la absorción de impactos.',110,6,'images/guantes.jpg'),
 (26,'Espaldera Kawasaki de Forcefield','Espaldera Kawasaki de Forcefield. Absorbe más energía y resiste numerosos impactos en mayor medida que otros protectores tradicionales en el mercado.','Espaldera Kawasaki de Forcefield. Absorbe más energía y resiste numerosos impactos en mayor medida que otros protectores tradicionales en el mercado. Se adapta por sí misma a la forma exacta de la espalda del motorista para proporcionar un ajuste más cómodo y seguro que ninguna otra espaldera del mercado. Máxima protección nivel 2 CE (aprobada según EN1621-2:2003 y EN340:2003). Transpirable, ligera y muy flexible. De gran solidez, su pequeño tamaño permiten utilizarla fácilmente bajo la ropa de montar.',149,6,'images/espaldera.jpg'),
 (27,'Casco Ninja','Casco integral Supersport con forro acolchado.','Casco integral Supersport Forro / acolchado interior: AquaTrans®; desmontable y lavable. Pantalla: V9-Ninja transparente, antirrayas y antivaho con mecanismo de bloqueo de pantalla. Sistema de cierre: argolla en D doble Carcasa exterior: fibra de vidrio/Spectra/Kevlar Tallas: XS (53-54) – XXL (63-64) Colores: Dragon KC4 F (verde/plata/negro), KC5 F (antracita/plata/negro) Productos autorizados.',349,7,'images/casconinja.jpg'),
 (28,'Casco MX','Forro / acolchado interior.','Forro / acolchado interior:AquaTrans®; desmontable y lavable.\r\n\r\n	\r\n\r\nSistema de cierre: argolla en D doble\r\n\r\n	\r\n\r\nCarcasa exterior: fibra de vidrio/Spectra/Kevlar',259,7,'images/cascomx.jpg'),
 (29,'AGV GP-PRO GOTHIC 46','Calota fabricada en fibra de carbono y Kevlar.','Casco Agv gp-pro. Calota de fibra Kevlar/Carbono, tecnología Core-System. Sistema de ventilación X-Vent con tomas de aire y canalización interna. Acolchados interiores desmontables, confeccionados con Coolmax, lavables, transpirables y antialérgicos.',382,7,'images/cascoagvgpro.jpg'),
 (30,'AGV K-3 ROSSI MOTO GP AZUL','Casco en resina termoplástica HIR-TH.','Sistema Dinámico de ventilación, con tres entradas de aire frontales un superior y dos salidas traseras. Interior totalmente desmontable y lavable, excepto paranuca. Protección mentonera desmontable y lavable. Protector nariz desmontable. Pantalla STREET 8 de policarbonato, antiempañante y antiraya. Sistema de retención Micro-Lock. Correa de sujeción con cierre rápido y anilla antirrobo. Bolsa Portacasco incluida. El casco se suministra con Pantalla Transparente. La Pantalla Ahumada se vende por separado.',170,7,'images/cascoagvrossi.jpg'),
 (31,'ARAI CHASER Force Blanco','Calota interna en múltiples densidades (sistema patentado).','Casco Arai Chaser Force, Diseñado especialmente para la conducción Touring. Calota exterior de fibra de vidrio. Calota interna de phorexpan. Calota interna en múltiples densidades (sistema patentado). Nervio en la calota para la hiper-riguidez. Pantalla antiempañante con pinlock, Sistema de ventilación en pantalla. Con sistema FFS para reducir el ruido. Acolchado lateral desmontable. Tapas laterales integradas en la calota Uña de cierre de la pantalla. Sistema LRS para el cambio de pantalla sin herramientas. Calota interna en múltiples densidades (sistema patentado). Nervio en la calota para la hiper-riguidez. Pantalla antiempañante con pinlock, Sistema de ventilación en pantalla. Con sistema FFS para reducir el ruido. Acolchado lateral desmontable. Tapas laterales integradas en la calota, Uña de cierre de la pantalla. Sistema LRS para el cambio de pantalla sin herramientas.',559,7,'images/cascoarai.jpg'),
 (32,'SHOEI XR1000 CAMINO','Calota externa AIM + Shell (Advanced Integrated Matrix + Shell).','Casco Shoei XR-1000 Nightwing TC-5. Ideal para conducción de moto deportiva. Tambien apropiado para uso street/turismo.\r\n\r\n	\r\n\r\nCalota de AIM + Fibra de vidrio organica, multicomposite. Es una fibra organica de alto rendimiento en varias capas para que absorba los golpes, proteja la cabeza y mantenta la maxima rigidez. Pantalla pinlock anti-niebla CX-1V, con mecanismo de la pantalla dual, doble resistente, rapido y facil de cambiar. Cierre de doble hebilla facil de usar y siempre perfectamente ajustado. Acolchado central, y el lateral lavable-desmontable. Entrada de ventilacion en la frente y en el menton para el suministro de aire fresco. Salidas de ventilacion en la parte posterior del casco integradas en el Aero Wing Spoiler y en la zona del cuello para expulsar el aire utilizado.',409,7,'images/cascoshoei.jpg'),
 (33,'Tubo Escape - VN900 Vance y Hines Slass-cut',NULL,'Tubo de Escape Cromado 3´´ para VN900 Vance y Hines Slass-Cut.',650,8,'images/tuboEscape.jpg'),
 (34,'Reloj Highway Hawk Tech Glide','Para manillares de 22 y 25 mm.','Para manillares de 22 y 25 mm.',92,8,'images/reloj.jpg'),
 (35,'Funda Moto - Bike-it plata',NULL,NULL,24,8,'images/funda.jpg'),
 (36,'Cubredeposito negro VN900 Spaan','Cubredepósito de piel (corbata) para Vulcan 900 Custom/Classic, Honda C4, Suzuki C 800/Volusia y Yamaha Dragstar 1100 CL.','Cubredepósito de piel (corbata) para Vulcan 900 Custom/Classic, Honda C4, Suzuki C 800/Volusia y Yamaha Dragstar 1100 CL.',68,8,'images/cubredeposito.jpg'),
 (37,'Piñas Cromadas - Brake VN900','Piñas Cromadas Brake VN900',NULL,61,8,'images/piña.jpg'),
 (38,'Portamatriculas - Cromo aguila Spaan',NULL,NULL,39,8,'images/portamatricula.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;


--
-- Definition of table `ubicacion`
--

DROP TABLE IF EXISTS `ubicacion`;
CREATE TABLE `ubicacion` (
  `id_ubicacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_ub` varchar(30) NOT NULL,
  `num_categ` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_ubicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ubicacion`
--

/*!40000 ALTER TABLE `ubicacion` DISABLE KEYS */;
INSERT INTO `ubicacion` (`id_ubicacion`,`nombre_ub`,`num_categ`) VALUES 
 (1,'Motocicletas',5),
 (2,'Accesorios',3);
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(12) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `dni` varchar(9) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `pregunta` varchar(45) DEFAULT NULL,
  `respuesta` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`,`login`,`pass`,`tipo`,`nombre`,`apellidos`,`dni`,`direccion`,`codigo_postal`,`email`,`pregunta`,`respuesta`) VALUES 
 (1,'admin','admin','a','Bernardo','Pericacho Sánchez','05208612D','c/ corumba 14','28027','bernardo.sanperi@telefonica.net','eres el admin','si'),
 (2,'user','user','u','bernardo','pericacho sanchez','05208612d','mi calle','28029','yo@hotmail.com','¿no te acuerdas?','si'),
 (3,'prueba','prueba','u','prueba','prueba','05208612D','FDI','28029','','¿Cuál es tu animal preferido?','perro');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
