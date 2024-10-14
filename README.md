資料庫測驗

題目一
------------------------------------------------------------------
SELECT 
    o.bnb_id, 
    b.name AS bnb_name, 
    SUM(o.amount) AS may_amount
FROM 
    orders as o
JOIN 
    bnbs as b 
ON 
    o.bnb_id = b.id
WHERE 
    o.currency = 'TWD'
AND 
    o.created_at >= '2023-05-01 00:00:00'
AND 
    o.created_at < '2023-06-01 00:00:00'
GROUP BY 
    o.bnb_id, 
    b.name
ORDER BY 
    may_amount DESC
LIMIT 
    10;
------------------------------------------------------------------


