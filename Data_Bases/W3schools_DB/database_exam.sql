-- Examen base de datos Isael_Pineda_Hernandez 

-- 1er query: ¿Cual fue el item que mas se vendio?
SELECT 
  p.ProductID, 
  p.ProductName, 
  SUM(od.Quantity) AS Total 
FROM products AS p
JOIN order_details AS od ON p.ProductID = od.ProductID
GROUP BY p.ProductID, p.ProductName  
ORDER BY Total DESC
LIMIT 1; 

-- 2do query: ¿Quien fue el cliente que mas compro cuantos items y cantidad $$?
SELECT 
  c.CustomerName, 
  SUM(od.Quantity) AS TotalQty,
  SUM(od.Quantity * p.Price) AS TotalSpent 
FROM orders AS o 
JOIN customers AS c ON c.CustomerID = o.CustomerID
JOIN order_details AS od ON od.OrderID = o.OrderID
JOIN products AS p ON p.ProductID = od.ProductID
GROUP BY o.CustomerID, c.CustomerName
ORDER BY TotalSpent DESC
LIMIT 1;

-- 3ero: ¿Cual fue el servicio de paqueteria mas usado?
SELECT 
  ShipperName,
  count(o.ShipperID) AS Total 
FROM orders AS o
JOIN shippers AS s ON o.ShipperID = s.ShipperID
GROUP BY o.ShipperID
ORDER BY total DESC
LIMIT 1; 

-- 4to query: Top 3 de categorias mas vendida
SELECT 
  CategoryName, 
  SUM(Quantity) as Total 
FROM products AS p 
JOIN categories AS c ON p.CategoryID = c.CategoryID
JOIN order_details AS od ON od.ProductID = p.ProductID
GROUP BY c.CategoryID
ORDER BY Total desc 
LIMIT 3;

-- 5to query: El empleado con menos ventas
SELECT 
  e.FirstName, 
  e.LastName, 
  SUM(od.Quantity) AS Total 
FROM order_details AS od 
JOIN orders AS o ON od.OrderID = o.OrderID
JOIN employees AS e ON  e.EmployeeID = o.EmployeeID
GROUP BY e.EmployeeID
ORDER BY Total ASC
LIMIT 1;

-- 6to query: El mes con mayor numero de ventas y dinero ganado
SELECT 
    DATE_FORMAT(o.OrderDate, '%Y-%m') AS YearMonth, 
    SUM(od.Quantity) AS TotalItemsSold, 
    SUM(od.Quantity * p.Price) AS TotalSold
FROM orders AS o
JOIN order_details AS od ON o.OrderID = od.OrderID
JOIN products AS p ON od.ProductID = p.ProductID
GROUP BY YearMonth
ORDER BY TotalSold DESC
LIMIT 1;
