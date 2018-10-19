SELECT Replace  
		(Replace  
		 (Replace  
		   (Format(SUM(ei.valor), 2), '.', '|'), ',', '.'), '|', ',') AS total FROM expenditure_installments ei
JOIN expenses_card ec
     ON (ec.id = ei.fk_expenses_card)
WHERE ec.descricao LIKE '%Clash Royale%'; 


SELECT * FROM framework.expenses_card;
DELETE FROM framework.expenses_card;
ALTER TABLE framework.expenses_card AUTO_INCREMENT = 1;
ALTER TABLE expenses_card AUTO_INCREMENT = 1;


INSERT INTO framework.expenses_card (descricao, data_compra, fk_credit_cards, created_at, updated_at) 
SELECT DISTINCT
    despesa AS descricao,
    data_compra AS data_compra,
    fk_id_cartao_credito AS fk_credit_cards,
    '2018-10-18 18:45:45' AS created_at,
    '2018-10-18 18:45:45' AS updated_at
FROM
    financeiro.tb_despesa_cartao
WHERE
    fk_id_cartao_credito = 1
        AND data_compra > '2016-01-01'
ORDER BY despesa , parcela ASC;


SELECT 
	despesa AS descricao,
    data_compra AS data_compra,
	valor_compra AS valor,
    parcela AS numero_parcela,
    data_pagamento AS data_pagamento,
    
	NOW() AS created_at,
    NOW() AS updated_at
FROM
    financeiro.tb_despesa_cartao
WHERE
    fk_id_cartao_credito = 2 AND data_compra > '2016-01-01'
ORDER BY despesa, parcela ASC;

SELECT 
    parcela AS numero_parcela
FROM
    financeiro.tb_despesa_cartao
WHERE
    fk_id_cartao_credito = 1 AND data_compra > '2016-01-01'
ORDER BY despesa, parcela ASC;

