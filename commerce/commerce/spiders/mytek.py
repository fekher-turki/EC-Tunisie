# -*- coding: utf-8 -*-
import scrapy
import time
from scrapy.selector import Selector
from commerce.items import CommerceItem


class MytekSpider(scrapy.Spider):
	name = "mytek"
	allowed_domains = ["mytek.tn"]
	start_urls = [
		"http://www.mytek.tn/3-informatique?id_category=3&n=9999/",
		"http://www.mytek.tn/104-telephonie-tunisie?id_category=104&n=9999/",
		"http://www.mytek.tn/361-apple?id_category=361&n=9999/",
		"http://www.mytek.tn/7-impression?id_category=7&n=9999/",
		"http://www.mytek.tn/39-image-son?id_category=39&n=9999/",
		"http://www.mytek.tn/60-composants?id_category=60&n=9999/",
		"http://www.mytek.tn/83-accessoires?id_category=83&n=9999/",
		"http://www.mytek.tn/57-reseaux-securite-tunisie?id_category=57&n=9999/",
		"http://www.mytek.tn/5-jeux-tunisie?id_category=5&n=9999/",
		"http://www.mytek.tn/273-bureautique?id_category=273&n=9999/",
		"http://www.mytek.tn/4-electromenager-tunisie?id_category=4&n=9999/"
	]

	def parse(self, response):
		item = CommerceItem()
		x = response.xpath('//*[contains(@class, "product_list grid")]/li')
		for i in range(0, len(x)):
			item['revendeur'] =('mytek')
			item['categorie'] = response.xpath('//*[contains(@class, "breadcrumb clearfix")]/text()[3]').extract()
			item['titre'] = response.xpath('//*/div/div/h5/a[contains(@class, "product-name")]/text()').extract()[i]
			item['image'] = response.xpath('//*/div/div/a/img[contains(@class, "replace-2x img-responsive")]/@src').extract()[i]
			item['url'] = response.xpath('//*/div/div/h5/a[contains(@class, "product-name")]/@href').extract()[i]
			item['desc'] = response.xpath('//*/div/div/p[contains(@class, "product-desc-grid")]/text()').extract()[i]
			item['prix'] = (response.xpath('//*/tr/td/span[contains(@class, "price product-price")]/text()').extract()[i]).replace(",",".").replace("DT","").replace(" ","")
			item['date'] = time.strftime("%Y-%m-%d")
			yield item
