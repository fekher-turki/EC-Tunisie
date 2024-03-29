# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class CommerceItem(scrapy.Item):
	# define the fields for your item here like:
	revendeur = scrapy.Field()
	categorie = scrapy.Field()
	titre = scrapy.Field()
	image = scrapy.Field()
	url = scrapy.Field()
	desc = scrapy.Field()
	prix = scrapy.Field()
	date = scrapy.Field()
