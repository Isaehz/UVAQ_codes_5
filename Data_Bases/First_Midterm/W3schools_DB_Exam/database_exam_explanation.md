# Examen Base de Datos — Explicación

Este examen se basa en la **base de datos de ejemplo de W3Schools**.  

---

## 1. ¿Cuál fue el item que más se vendió?

```sql
-- Selecciona el producto más vendido sumando la cantidad total vendida de cada producto
SELECT 
  p.ProductID, 
  p.ProductName, 
  SUM(od.Quantity) AS Total 
FROM products AS p
JOIN order_details AS od ON p.ProductID = od.ProductID
GROUP BY p.ProductID, p.ProductName  
ORDER BY Total DESC
LIMIT 1;
```

---

## 2. ¿Quién fue el cliente que más compró, cuántos items y cantidad de dinero gastada?

```sql
-- Selecciona el cliente que más gastó y la cantidad total de items que compró
SELECT 
  c.CustomerName, 
  SUM(od.Quantity) AS TotalQty,
  SUM(od.Quantity * p.Price) AS TotalSpent 
FROM orders AS o 
JOIN customers AS c ON c.CustomerID = o.CustomerID
JOIN order_details AS od ON od.OrderID = o.OrderID
JOIN products AS p ON p.ProductID = od.ProductID
GROUP BY c.CustomerID, c.CustomerName
ORDER BY TotalSpent DESC
LIMIT 1;
```

---

## 3. ¿Cuál fue el servicio de paquetería más usado?

```sql
-- Selecciona el servicio de paquetería utilizado en más órdenes
SELECT 
  s.ShipperName,
  COUNT(o.ShipperID) AS Total 
FROM orders AS o
JOIN shippers AS s ON o.ShipperID = s.ShipperID
GROUP BY s.ShipperID, s.ShipperName
ORDER BY Total DESC
LIMIT 1;
```

---

## 4. Top 3 de categorías más vendidas

```sql
-- Selecciona las tres categorías con mayor cantidad de productos vendidos
SELECT 
  c.CategoryName, 
  SUM(od.Quantity) AS Total 
FROM products AS p 
JOIN categories AS c ON p.CategoryID = c.CategoryID
JOIN order_details AS od ON od.ProductID = p.ProductID
GROUP BY c.CategoryID, c.CategoryName
ORDER BY Total DESC 
LIMIT 3;
```

---

## 5. El empleado con menos ventas

```sql
-- Selecciona el empleado que vendió menos productos en total
SELECT 
  e.FirstName, 
  e.LastName, 
  SUM(od.Quantity) AS Total 
FROM order_details AS od 
JOIN orders AS o ON od.OrderID = o.OrderID
JOIN employees AS e ON e.EmployeeID = o.EmployeeID
GROUP BY e.EmployeeID, e.FirstName, e.LastName
ORDER BY Total ASC
LIMIT 1;
```

---

## 6. El mes con mayor número de ventas y dinero ganado

```sql
-- Selecciona el mes con más ventas y mayor ingreso total
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
```

---
