# Query Optimization Summary

## Problem
The `admin/profiles` route was timing out with error:
```
SQLSTATE[70100]: Query execution was interrupted (max_statement_time exceeded)
```

## Root Cause
The `Profile::profiles()` query has:
- 20+ LEFT JOINs to the `masterdata` table
- GROUP BY on all users (processes entire table before LIMIT)
- GROUP_CONCAT for images
- No indexes on frequently joined columns

## Solution Implemented

### 1. Query Optimization (Profile.php)
- **Before**: Query processed all users, then applied LIMIT
- **After**: Uses derived table to limit users FIRST, then joins
- **Result**: Only processes 10 users instead of all users

### Key Changes:
```php
// Old approach: Process all users, then limit
FROM users u
LEFT JOIN ... (20+ joins)
GROUP BY u.id
ORDER BY u.updated_at DESC
LIMIT 10

// New approach: Limit users first, then join
FROM (
    SELECT u.id FROM users u 
    ORDER BY u.updated_at DESC 
    LIMIT 10
) as limited_users
INNER JOIN users u ON limited_users.id = u.id
LEFT JOIN ... (20+ joins)
GROUP BY u.id
```

### 2. Count Query Optimization
- Separate optimized count query (no joins needed)
- Much faster for pagination

### 3. Database Indexes (Recommended)
Run `database_indexes_optimization.sql` to add:
- Index on `users.updated_at` (for ordering)
- Index on `users.active` (for filtering)
- Index on `users.dataid` (for lookups)
- Composite index on `masterdata(type, dataid)` (for JOINs)
- Index on `images.user_id` (for image joins)

## Performance Impact

### Expected Improvements:
- **Query Time**: From 30+ seconds → < 1 second
- **Memory Usage**: Reduced (processes only 10 rows)
- **Database Load**: Significantly reduced

## How to Apply

### Step 1: Code Changes (Already Done)
✅ `app/Profile.php` - Query optimized

### Step 2: Add Database Indexes (Required)
```bash
# Option 1: Run SQL file directly
mysql -u your_user -p your_database < database_indexes_optimization.sql

# Option 2: Copy SQL and run in phpMyAdmin or MySQL client
```

### Step 3: Test
1. Visit `admin/profiles`
2. Should load in < 1 second
3. Check query execution time in logs

## Additional Recommendations

### If Still Slow:
1. **Add WHERE clause** to filter inactive users:
   ```php
   // In AdminController::profiles()
   $members = Profile::profiles("`u`.`active`=1", null, "`u`.`updated_at` DESC", "10");
   ```

2. **Increase MySQL max_statement_time** (if needed):
   ```sql
   SET GLOBAL max_statement_time = 60; -- 60 seconds
   ```

3. **Consider pagination** - Load fewer records per page

4. **Cache results** - Cache profile data for frequently accessed users

## Monitoring

Check query performance:
```sql
-- Enable query logging
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 1;

-- Check slow queries
SELECT * FROM mysql.slow_log ORDER BY start_time DESC LIMIT 10;
```

## Files Modified
- ✅ `app/Profile.php` - Optimized `profiles()` method
- 📄 `database_indexes_optimization.sql` - Index creation script
- 📄 `QUERY_OPTIMIZATION_SUMMARY.md` - This document

