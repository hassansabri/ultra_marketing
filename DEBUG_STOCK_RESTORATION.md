# 🐛 Debug Stock Restoration Issue

## **Problem**: Stock not being restored after order cancellation

## 🔍 **What to Check**

### 1. **Database Tables**
Verify these tables exist and are accessible:
- `stocks` - main stock table
- `stocks_logs` - stock transaction logs
- `orders` - order information
- `order_detail` - order attribute details

### 2. **Stock Restoration Flow**
```
Order Cancellation → restoreStockForOrder() → restoreStock() → Update stocks table
```

### 3. **Debug Steps**

#### **Step 1: Check Order Status**
- Verify order status changes from 'confirm' to 'draft'
- Check `modified_date` vs `created_date`

#### **Step 2: Check Stock Restoration Method**
- Look for errors in `restoreStockForOrder()` method
- Verify `restoreStock()` method is called
- Check if stock data is correctly formatted

#### **Step 3: Check Database Updates**
- Verify `stocks` table is updated
- Check `stocks_logs` for restoration entries
- Confirm stock balance increases

## 🧪 **Testing Steps**

### **Test 1: Simple Order Cancellation**
1. Create a simple order (no attributes)
2. Complete the order (status = 'confirm')
3. Cancel the order
4. Check if stock is restored

### **Test 2: Attribute-based Order Cancellation**
1. Create order with attributes (grade, size, etc.)
2. Complete the order
3. Cancel the order
4. Check if stock is restored for each attribute

### **Test 3: Check Stock Logs**
1. Look in `stocks_logs` table
2. Find entries with `stock_type = 'restoration'`
3. Verify quantities match cancelled order

## 🆘 **Common Issues**

### **Issue 1: WHERE Clause Problems**
- Missing `brand_fk` condition in stock updates
- Zero values not handled properly
- Attribute matching fails

### **Issue 2: Data Type Mismatches**
- String vs integer comparisons
- Null vs zero values
- Attribute type mismatches

### **Issue 3: Database Constraints**
- Foreign key violations
- Unique constraint violations
- Transaction rollbacks

## 🔧 **Quick Fixes to Try**

### **Fix 1: Clear Database Cache**
```sql
FLUSH TABLES;
```

### **Fix 2: Check Stock Records**
```sql
SELECT * FROM stocks WHERE item_fk = [ITEM_ID];
```

### **Fix 3: Verify Order Details**
```sql
SELECT * FROM order_detail WHERE order_number_fk = '[ORDER_NUMBER]';
```

### **Fix 4: Check Stock Logs**
```sql
SELECT * FROM stocks_logs WHERE stock_type = 'restoration' ORDER BY entry_date DESC LIMIT 10;
```

## 📊 **Expected Results**

### **Before Cancellation**
- Order status: 'confirm'
- Stock balance: [ORIGINAL] - [ORDER_QUANTITY]

### **After Cancellation**
- Order status: 'draft'
- Stock balance: [ORIGINAL] (restored)
- Stock log: restoration entry with positive quantity

## 🎯 **Next Steps**

1. **Test simple order cancellation**
2. **Check database for stock updates**
3. **Verify stock logs are created**
4. **Report specific error messages**

---

**Run these tests and let me know what you find!** 🔍 