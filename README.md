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
題目二
1.使用Explain確認效能瓶頸在哪裡，例如是否在 JOIN 上花費過多時間，或是因為缺少index而導致全表掃描。

2.使用index：如果上述的分析指出缺乏適當的index存在，我就會添加index，比方說在bnb_id加index來加速join。如果某兩個條件常常一起搜尋也可以考慮做複合index。

3.分表：如果上述方式確認已達極限，就會考慮分表，常見的分表方式是根據時間，如按照年跟月去分表，但題目是搜尋整個五月，所以不適合用常見的按照時間去分
或許可以考慮根據旅宿的名字去分，比方說A-M/N-Z，但還是要看實際狀況決定。


