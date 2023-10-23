# -*- coding: utf-8 -*-
import scrapy
import time
from scrapy.selector import Selector
from commerce.items import CommerceItem


class TunisianetSpider(scrapy.Spider):
	name = "tunisianet"
	allowed_domains = ["tunisianet.com.tn"]
	start_urls = [
		"http://www.tunisianet.com.tn/301-ordinateur-portable?n=999/",
		"http://www.tunisianet.com.tn/396-tablette-tactile-tunisie?n=999/",
		"http://www.tunisianet.com.tn/373-ordinateur-bureau-tunisie?n=999/",
		"http://www.tunisianet.com.tn/374-ecran-ordinateur-tunisie?n=999/",
		"http://www.tunisianet.com.tn/375-serveur-informatique-tunisie?n=999/",
		"http://www.tunisianet.com.tn/385-logiciels-informatique-tunisie?n=999/",
		"http://www.tunisianet.com.tn/377-telephone-portable-tunisie?n=999/",
		"http://www.tunisianet.com.tn/596-smartphone-android?n=999/",
		"http://www.tunisianet.com.tn/597-windows-phone?n=999/",
		"http://www.tunisianet.com.tn/598-iphone?n=999/",
		"http://www.tunisianet.com.tn/462-telephones-fixes?n=999/",
		"http://www.tunisianet.com.tn/378-accessoire-telephonie-mobile-tunisie?n=999/",
		"http://www.tunisianet.com.tn/593-montre-tunisie?n=999/",
		"http://www.tunisianet.com.tn/313-disque-dur-externe-tunisie?n=999/",
		"http://www.tunisianet.com.tn/458-disques-durs-internes?n=999/",
		"http://www.tunisianet.com.tn/546-disques-durs-internes-reconditionnes?n=999/",
		"http://www.tunisianet.com.tn/469-accessoires-pour-stockage?n=999/",
		"http://www.tunisianet.com.tn/314-cle-usb-tunisie?n=999/",
		"http://www.tunisianet.com.tn/315-carte-memoire-tunisie?n=999/",
		"http://www.tunisianet.com.tn/452-cd-dvd-vierge?n=999/",
		"http://www.tunisianet.com.tn/389-serveur-stockage-tunisie?n=999/",
		"http://www.tunisianet.com.tn/316-imprimante-en-tunisie?n=999/",
		"http://www.tunisianet.com.tn/455-imprimante-a-reservoir-integre?n=999/",
		"http://www.tunisianet.com.tn/487-serveur-impression-tunisie?n=999/",
		"http://www.tunisianet.com.tn/317-consommable-tunisie?n=999/",
		"http://www.tunisianet.com.tn/444-photocopieur-tunisie?n=999/",
		"http://www.tunisianet.com.tn/324-appareil-fax-telephone-tunisie?n=999/",
		"http://www.tunisianet.com.tn/326-scanner-informatique?n=999/",
		"http://www.tunisianet.com.tn/369-vente-tv-samsung-led-tunisie?n=999/",
		"http://www.tunisianet.com.tn/402-recepteur-abonnement-dreambox?n=999/",
		"http://www.tunisianet.com.tn/368-vente-videoprojecteur-tunisie?n=999/",
		"http://www.tunisianet.com.tn/370-appareil-photo-tunisie?n=999/",
		"http://www.tunisianet.com.tn/484-piles-et-chargeurs-tunisie?n=999/",
		"http://www.tunisianet.com.tn/466-consoles-jeux?n=999/",
		"http://www.tunisianet.com.tn/457-climatiseur-tunisie-chaud-froid?n=999/",
		"http://www.tunisianet.com.tn/470-cigarette-electronique-tunisie?n=999/",
		"http://www.tunisianet.com.tn/553-chauffage-tunisie?n=999/",
		"http://www.tunisianet.com.tn/524-entretien-soin?n=999/",
		"http://www.tunisianet.com.tn/521-gros-electromenager-tunisie?n=999/",
		"http://www.tunisianet.com.tn/522-petit-electromenager-tunisie-cuisine?n=999/",
		"http://www.tunisianet.com.tn/563-gros-electromenager-lavage?n=999/",
		"http://www.tunisianet.com.tn/331-malette-ordinateur-portable?n=999/",
		"http://www.tunisianet.com.tn/332-clavier-souris?n=999/",
		"http://www.tunisianet.com.tn/336-webcams?n=999/",
		"http://www.tunisianet.com.tn/337-son?n=999/",
		"http://www.tunisianet.com.tn/341-mannettes-jeu?n=999/",
		"http://www.tunisianet.com.tn/342-code-barre?n=999/",
		"http://www.tunisianet.com.tn/346-lecteurs-cartes?n=999/",
		"http://www.tunisianet.com.tn/348-cameras-ip-tunisie?n=999/",
		"http://www.tunisianet.com.tn/358-divers?n=999/",
		"http://www.tunisianet.com.tn/456-accessoires-tablettes-smartphones?n=999/",
		"http://www.tunisianet.com.tn/498-hub-usb-tunisie?n=999/",
		"http://www.tunisianet.com.tn/499-nettoyage?n=999/",
		"http://www.tunisianet.com.tn/507-sac-a-dos-tunisie?n=999/",
		"http://www.tunisianet.com.tn/500-refroidisseurs?n=999/",
		"http://www.tunisianet.com.tn/438-reseau?n=999/",
		"http://www.tunisianet.com.tn/349-cable-connectique-informatique?n=999/",
		"http://www.tunisianet.com.tn/380-onduleur-in-line?n=999/",
		"http://www.tunisianet.com.tn/605-traceur-tracker-gps-de-voiture?n=999/",
		"http://www.tunisianet.com.tn/509-videosurveillance-tunisie?n=999/",
		"http://www.tunisianet.com.tn/406-composant-ordinateur-bureau?n=999/",
		"http://www.tunisianet.com.tn/407-composant-ordinateur-portable?n=999/",
		"http://www.tunisianet.com.tn/430-composant-serveur-informatique?n=999/",
		"http://www.tunisianet.com.tn/449-calculatrice-tunisie?n=999/",
		"http://www.tunisianet.com.tn/451-destructeur-de-papier-tunisie?n=999/",
		"http://www.tunisianet.com.tn/463-ramette-de-papier?n=999/",
		"http://www.tunisianet.com.tn/481-fournitures-scolaires-en-ligne?n=999/",
		"http://www.tunisianet.com.tn/475-fourniture-ecriture-scolaire-tunisie?n=999/",
		"http://www.tunisianet.com.tn/490-materiel-point-de-vente?n=999/",
		"http://www.tunisianet.com.tn/501-fourniture-classement-archivage-tunisie?n=999/",
		"http://www.tunisianet.com.tn/547-impression-tunisie?n=999/",
		"http://www.tunisianet.com.tn/572-tableau-bureautique-tunisie?n=999/",
		"http://www.tunisianet.com.tn/589-cahier-bloc-feuille-note?n=999/",
		"http://www.tunisianet.com.tn/649-accessoires-de-bureau?n=999/",
		"http://www.tunisianet.com.tn/554-sports-loisirs?n=999/",
		"http://www.tunisianet.com.tn/591-bricolage-tunisie?n=999/",
		"http://www.tunisianet.com.tn/556-cuisson-ustensiles-de-cuisine-tunisie?n=999/",
		"http://www.tunisianet.com.tn/603-maison?n=999/"
	]

	def parse(self, response):
		item = CommerceItem()
		x = response.xpath('//*[contains(@class, "ajax_block_product")]')
		for i in range(0, len(x)):
			item['revendeur'] = ('tunisianet')
			item['categorie'] = response.xpath('//*[contains(@class, "breadcrumb")]/strong/a/text()').extract()
			item['titre'] = response.xpath('//*[contains(@class, "center_block")]/h2/a/text()').extract()[i]
			item['image'] = response.xpath('//*[contains(@class, "product_img_link")]/img/@src').extract()[i]
			item['url'] = response.xpath('//*[contains(@class, "center_block")]/h2/a/@href').extract()[i]
			item['desc'] = response.xpath('//*[contains(@class, "product_desc")]/a/text()').extract()[i]
			item['prix'] = (response.xpath('//*[@id="produit_liste_prix"]/div[1]/span/text()').extract()[i]).replace(",",".").replace("DT","").replace(" ","")
			item['date'] = time.strftime("%Y/%m/%d")
			yield item
