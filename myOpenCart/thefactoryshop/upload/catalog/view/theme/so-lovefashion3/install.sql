DROP TABLE IF EXISTS ?:layout_module;
CREATE TABLE `?:layout_module` (
  `layout_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `position` varchar(14) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`layout_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4702 DEFAULT CHARSET=utf8;

INSERT INTO ?:layout_module VALUES
("4696","1","so_listing_tabs.217","content_top","7"),
("4694","1","so_html.224","content_block3","0"),
("4693","1","manufacturers","content_block4","0"),
("4692","1","so_html.222","content_top","6"),
("4691","1","so_listing_tabs.218","content_top","5"),
("4690","1","so_html.220","content_top","2"),
("4689","1","so_html.215","content_top","0"),
("4688","1","so_html.221","content_top","4"),
("4687","1","so_deals.216","content_top","3"),
("4684","1","latest.223","content_block1","0"),
("4685","1","so_newletter_custom_popup.226","content_top","0"),
("4686","1","newsletters","content_top","8"),
("4683","1","so_searchpro.94","content_search","0"),
("4682","1","so_latest_blog.227","content_block2","0"),
("4681","1","so_home_slider.225","content_top","1"),
("4695","1","so_megamenu.118","content_menu","0"),
("4529","2","category","column_right","0"),
("4530","2","so_megamenu.118","content_menu","0"),
("4528","2","so_searchpro.94","content_search","0"),
("4516","3","latest.96","column_left","2"),
("4515","3","so_filter_shop_by.164","column_left","0"),
("4514","3","so_searchpro.94","content_search","0"),
("4513","3","so_megamenu.118","content_menu","2"),
("4504","4","so_megamenu.119","content_block1","0"),
("4503","4","so_megamenu.118","content_menu","0"),
("4502","4","so_searchpro.94","content_search","0"),
("4527","5","so_searchpro.94","content_search","0"),
("4526","5","so_megamenu.118","content_menu","0"),
("4510","6","so_megamenu.118","content_menu","0"),
("4509","6","so_searchpro.94","content_search","0"),
("4508","6","account","column_right","0"),
("4518","7","so_megamenu.118","content_menu","0"),
("4517","7","so_searchpro.94","content_search","0"),
("4522","8","so_megamenu.118","content_menu","0"),
("4521","8","so_searchpro.94","content_search","0"),
("4538","9","so_megamenu.118","content_menu","0"),
("4537","9","so_searchpro.94","content_search","0"),
("4700","10","so_searchpro.94","content_search","0"),
("4699","10","so_megamenu.118","content_menu","0"),
("4701","10","affiliate","column_right","0"),
("4525","11","so_megamenu.118","content_menu","0"),
("4524","11","so_megamenu.119","content_block1","0"),
("4523","11","so_searchpro.94","content_search","0"),
("4520","12","so_searchpro.94","content_search","0"),
("4519","12","so_megamenu.118","content_menu","0"),
("4532","13","so_searchpro.94","content_search","0"),
("4531","13","so_megamenu.118","content_menu","0"),
("4372","16","so_html.202","column_left","5"),
("4371","16","so_latest_blog.124","content_block5","0"),
("4370","16","newsletters","column_left","4"),
("4369","16","so_html.200","column_left","2"),
("4367","16","so_extra_slider.196","content_block4","0"),
("4368","16","so_deals.201","column_left","3"),
("4365","16","so_extra_slider.195","content_block3","0"),
("4366","16","so_listing_tabs.189","content_block2","1"),
("4364","16","so_searchpro.94","content_search","0"),
("4363","16","so_megamenu.204","content_menu","0"),
("4362","16","so_megamenu.119","content_block1","0"),
("4361","16","so_extra_slider.198","column_left","0"),
("4359","16","so_home_slider.174","content_top","0"),
("4360","16","so_html.188","content_block2","0"),
("4357","16","so_html.199","column_left","1"),
("4358","16","so_html.190","content_block2","2"),
("4356","16","manufacturers","content_block6","0"),
("4405","29","so_megamenu.118","content_menu","0"),
("4404","29","so_searchpro.94","content_search","0"),
("4535","31","so_megamenu.118","content_menu","0"),
("4534","31","simple_blog_category","column_left","0"),
("4533","31","so_searchpro.94","content_search","0"),
("4536","31","latest.96","column_left","2"),
("4507","42","so_megamenu.119","content_block1","0"),
("4506","42","so_searchpro.94","content_search","0"),
("4505","42","so_megamenu.204","content_menu","0"),
("4428","43","latest.96","column_left","0"),
("4426","43","so_megamenu.204","content_menu","0"),
("4425","43","so_megamenu.119","content_block1","0"),
("4424","43","so_searchpro.94","content_search","0"),
("4427","43","simple_blog_category","column_left","1"),
("4439","44","so_megamenu.119","content_block1","0"),
("4440","44","so_megamenu.204","content_menu","0"),
("4441","44","so_searchpro.94","content_search","0"),
("4442","44","so_filter_shop_by.164","column_left","0"),
("4443","44","latest.96","column_left","1"),
("4501","45","category","column_right","0"),
("4500","45","so_megamenu.204","content_menu","0"),
("4499","45","so_megamenu.119","content_block1","0"),
("4498","45","so_searchpro.94","content_search","0"),
("4488","46","so_megamenu.119","content_block1","0"),
("4489","46","so_megamenu.204","content_menu","0"),
("4490","46","so_searchpro.94","content_search","0"),
("4491","46","simple_blog_category","column_left","0"),
("4492","46","latest.96","column_left","1"),
("4583","47","so_html.205","content_block4","0"),
("4582","47","newsletters","content_block4","1"),
("4581","47","so_html.183","content_block6","0"),
("4580","47","so_latest_blog.124","content_block7","0"),
("4579","47","so_searchpro.94","content_search","0"),
("4578","47","so_home_slider.165","content_top","0"),
("4577","47","so_html.185","content_block2","0"),
("4576","47","so_html.186","content_block1","1");
INSERT INTO ?:layout_module VALUES
("4575","47","so_megamenu.118","content_menu","0"),
("4574","47","so_html.173","content_block1","0"),
("4573","47","so_listing_tabs.187","content_block3","0"),
("4572","47","so_html.184","content_block5","0"),
("4571","47","so_deals.182","content_block1","2"),
("4570","47","manufacturers","content_block8","0"),
("4584","47","so_html.206","content_block4","2"),
("4585","47","so_newletter_custom_popup.180","content_top","0"),
("4659","48","so_html.229","content_top","0"),
("4658","48","manufacturers","content_block6","0"),
("4657","48","latest.230","content_block3","0"),
("4656","48","so_html.231","content_block5","0"),
("4655","48","so_megamenu.118","content_menu","0"),
("4654","48","so_html.239","content_block2","0"),
("4653","48","so_html.236","content_block1","1"),
("4652","48","so_html.232","column_left","2"),
("4651","48","so_html.233","column_left","4"),
("4650","48","so_html.234","column_left","3"),
("4649","48","so_searchpro.94","content_search","0"),
("4648","48","so_megamenu.119","column_left","0"),
("4660","48","so_listing_tabs.237","content_block1","2"),
("4661","48","newsletters","column_left","1"),
("4662","48","so_home_slider.235","content_block1","0"),
("4663","48","so_listing_tabs.238","content_block1","3"),
("4664","48","so_latest_blog.227","content_block4","0");


