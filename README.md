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


API 實作測驗
SOLID 與 設計模式分別為何？
單一職責原則 (SRP): 一個類別只負責一件事，例如 OrderValidator 負責驗證，OrderTransformer 負責轉換。
介面隔離原則 (ISP): 用介面隔開模組間的依賴，保持抽象。介面（OrderValidatorInterface）保持不變，實作模組（Transformer）換掉也不應該影響到OrderSerive。
依賴反向原則 (DIP): 高層模組不應該依賴低層模組，所以OrderSerive反轉注入到OrderController，OrderValidatorInterface/OrderTransformerInterface反轉注入到OrderSerive。
策略模式: 我把不同的模組封裝起來，透過接口去調用，使得不同模組可以互相替換，靈活使用。


