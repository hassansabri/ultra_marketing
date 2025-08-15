# 🧪 Test Stock Restoration After Order Cancellation

## **Objective**: Verify that stock is properly restored when orders are cancelled

## ✅ **What Should Happen**

1. **Order Creation**: Stock is deducted when order is completed
2. **Order Cancellation**: Stock is restored when order is cancelled
3. **Stock Balance**: Final stock should equal original stock
4. **Stock Logs**: Restoration entries should be created

## 🔧 **Test Setup**

### **Prerequisites**
- Working order system
- Items with available stock
- Ability to create and complete orders

### **Test Data Needed**
- Item ID with known stock quantity
- Order with simple quantity (no attributes)

## 🧪 **Test Steps**

### **Step 1: Check Initial Stock**
```sql
SELECT * FROM stocks WHERE item_fk = [YOUR_ITEM_ID];
```
**Record**: Initial stock balance

### **Step 2: Create and Complete Order**
1. Create a new order with the test item
2. Set quantity to a reasonable number (e.g., 5)
3. Complete the order (status = 'confirm')
4. **Verify**: Stock should be deducted

### **Step 3: Check Stock After Order Completion**
```sql
SELECT * FROM stocks WHERE item_fk = [YOUR_ITEM_ID];
```
**Expected**: Stock balance = Initial - Order Quantity

### **Step 4: Cancel the Order**
1. Go to "All Complete Orders"
2. Find the test order
3. Click "Cancel Order"
4. Confirm cancellation
5. **Verify**: Order status should change to 'draft'

### **Step 5: Check Stock After Cancellation**
```sql
SELECT * FROM stocks WHERE item_fk = [YOUR_ITEM_ID];
```
**Expected**: Stock balance = Initial (fully restored)

### **Step 6: Check Stock Logs**
```sql
SELECT * FROM stocks_logs 
WHERE item_fk = [YOUR_ITEM_ID] 
ORDER BY entry_date DESC 
LIMIT 5;
```
**Expected**: 
- Deduction entry (negative balance)
- Restoration entry (positive balance)

## 📊 **Expected Results**

### **Stock Balance Changes**
```
Initial: 100
After Order: 95 (deducted)
After Cancellation: 100 (restored)
```

### **Stock Log Entries**
```
1. Deduction: balance = -5, stock_type = 'deduction'
2. Restoration: balance = 5, stock_type = 'restoration'
```

## 🆘 **If Stock is NOT Restored**

### **Check These Issues**

1. **Order Status**
   - Verify order status changed from 'confirm' to 'draft'
   - Check `modified_date` vs `created_date`

2. **Stock Restoration Method**
   - Check if `restoreStockForOrder()` is called
   - Verify `restoreStock()` method executes
   - Look for database errors

3. **Database Issues**
   - Verify `stocks` table is accessible
   - Check for foreign key constraints
   - Verify stock record exists

### **Debug Commands**

```sql
-- Check order status
SELECT order_number, order_status, created_date, modified_date 
FROM orders 
WHERE order_number = '[YOUR_ORDER_NUMBER]';

-- Check stock records
SELECT * FROM stocks WHERE item_fk = [YOUR_ITEM_ID];

-- Check stock logs
SELECT * FROM stocks_logs 
WHERE item_fk = [YOUR_ITEM_ID] 
ORDER BY entry_date DESC;
```

## 🎯 **Success Criteria**

✅ **Order cancellation works**
✅ **Stock is deducted on order completion**
✅ **Stock is restored on order cancellation**
✅ **Final stock equals initial stock**
✅ **Stock logs show both transactions**

## 🚀 **Next Steps**

1. **Run the test** with a simple order
2. **Report results** - what you see
3. **Check for errors** in logs
4. **Verify stock balance** changes

---

**Run this test and let me know the results!** 🧪 