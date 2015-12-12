
SELECT * FROM festivos;

SELECT 
	CONCAT("[",
		GROUP_CONCAT(CONCAT("{"),
			CONCAT("\"id_festivo\":\"",id_festivo,"\","),
			CONCAT("\"fecha\":\"",fecha,"\""),
		CONCAT("}")), 
	"]") AS json 
FROM 
	festivos







