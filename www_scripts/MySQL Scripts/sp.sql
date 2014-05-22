DELIMITER $$

USE `dev_yomo_hungrylion_bravebantam`$$

DROP PROCEDURE IF EXISTS `sp_cron_aggregate_tags`$$

CREATE DEFINER=`bravebantam`@`%` PROCEDURE `sp_cron_aggregate_tags`(IN start_date DATETIME)
BEGIN
    DROP TABLE IF EXISTS temp_cron_aggregate_tags;

    CREATE TEMPORARY TABLE temp_cron_aggregate_tags ENGINE=MYISAM AS
    (
	SELECT * FROM couponvoucher_basket_item cbi
	WHERE cbi.date_created BETWEEN start_date AND DATE_ADD(NOW(), INTERVAL -3 MINUTE)
    );


	INSERT INTO tracking_aggregate_tag
	(
	SELECT   	CONCAT(DATE(ts.start_datetime), ' ', HOUR(ts.start_datetime), ':00:00') AS 'date_time',
 			IF (cpu.`ussd_tag_id` IS NULL, '-1', cpu.`ussd_tag_id`) AS 'tag_id',
 			IF (cpu.`ussd_message` IS NULL, 'Root String', cpu.`ussd_message`) AS 'Publisher (Media)',
 			IF (cpu.`ussd_tag_id` IS NULL, '*120*452#', CONCAT('*120*452*', cpu.`ussd_tag_id`)) AS 'ussd_string',
 			COUNT( ts.id ) AS 'Visits',
 			(
 				SELECT    	COUNT( tcat.id ) 'coupons_issued'
 				FROM     	temp_cron_aggregate_tags tcat
 				LEFT JOIN    	couponvoucher_basket Xcb ON Xcb.id = tcat.`couponvoucher_basket_id`
 				LEFT JOIN  	tracking_session Xts ON Xts.id = tcat.tracking_session_id
 				LEFT JOIN  	campaign_plan_ussd Xcpu ON Xcpu.`campaign_plan_id` = Xts.`campaign_plan_id`
				WHERE     	CONCAT(DATE(Xts.start_datetime), ' ', HOUR(Xts.start_datetime), ':00:00') = `date_time`
 					AND 	IF(Xcpu.ussd_tag_id IS NULL, '0', Xcpu.ussd_tag_id) = IF(cpu.`ussd_tag_id` IS NULL, '0', cpu.`ussd_tag_id`)
 					AND 	Xts.session_type = 'USSD'
 			) AS 'Coupons Issued'
 	FROM   			tracking_session ts
 	LEFT JOIN  		campaign_plan_ussd cpu 		ON cpu.`campaign_plan_id` = ts.`campaign_plan_id`
 	LEFT JOIN  		campaign_plan cp 		ON cp.id = cpu.`campaign_plan_id`
 	LEFT JOIN  		campaign_publisher cpub 	ON cpub.id = cp.`campaign_publisher_id`
 	WHERE   		ts.session_type 		= 'USSD'
 			AND  	ts.`start_datetime` 		BETWEEN start_date AND DATE_ADD(NOW(), INTERVAL -3 MINUTE)
 	GROUP BY  		cpu.`ussd_tag_id`, `date_time`
 	ORDER BY 		cpu.`ussd_tag_id`
 	)
 	ON DUPLICATE KEY UPDATE
        publisher = VALUES(publisher),
        visits = VALUES(visits),
        coupons_issued = VALUES(coupons_issued),
        ussd_string = VALUES(ussd_string);

    END$$

DELIMITER ;