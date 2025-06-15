# MyWallet - Laravel Stock Portfolio App

## Assignment 3: Hacktivist - IDOR Prevention Implementation

This Laravel application demonstrates **Insecure Direct Object Reference (IDOR) prevention** using the **Principle of Least Privilege** in a stock portfolio management system.

## 🔒 IDOR Prevention Features

### **Stock Portfolio Management System**
Users can manage their personal stock portfolio with complete isolation between users.

**Key Features Implemented:**
- ✅ **User-specific data access** - Users can only view/edit/delete their own stocks
- ✅ **Authorization policies** - Server-side ownership validation
- ✅ **Session security** - HTTPS-only, HTTP-only, strict SameSite cookies
- ✅ **CSRF protection** - All forms protected against cross-site attacks

## 🧪 Testing IDOR Prevention (For Teachers)

### **Step 1: Create Test Users**
1. Visit the hosted app and register 2 different user accounts:
   - User A: `user1@test.com`
   - User B: `user2@test.com`

### **Step 2: Add Stocks to Each User**
1. **Login as User A** and navigate to **"My Stocks"**
2. Add a few stocks to User A's portfolio
3. **Logout and login as User B** 
4. Add different stocks to User B's portfolio

### **Step 3: Test IDOR Prevention**

#### **URLs to Test:**
- **Portfolio Management:** `/my-stocks`
- **Add Stock:** `/my-stocks/create`
- **Edit Stock:** `/my-stocks/{id}/edit`
- **View Stock:** `/my-stocks/{id}`

#### **IDOR Attack Scenarios:**
1. **Login as User A** and note a stock ID from the URL (e.g., `/my-stocks/5`)
2. **Login as User B** and try to access User A's stock:
   - Navigate to `/my-stocks/5` (User A's stock)
   - Try to edit: `/my-stocks/5/edit`

**Expected Behavior:** ❌ **Access Denied** - User B cannot access User A's data

### **Step 4: Verify Security Headers**
Open browser developer tools and check for security headers:
- `Set-Cookie` with `HttpOnly`, `Secure`, `SameSite=strict`
- CSRF tokens in all forms

## 🔧 Technical Implementation

### **Multi-Layer IDOR Prevention:**

1. **Database Level:** Foreign key constraints ensure data ownership
2. **Model Level:** Scoped queries filter by authenticated user
3. **Controller Level:** Authorization policies validate ownership
4. **Route Level:** Authentication middleware protects all endpoints

### **Key Security Features:**
- **User Isolation:** `ErrorPage::forUser(auth()->id())`
- **Policy Authorization:** `$this->authorize('view', $stock)`
- **Session Security:** Strict cookie settings
- **Input Validation:** All user inputs validated and sanitized

## 🚀 Live Demo URLs

- **Home:** `/`
- **Login:** `/login` 
- **Register:** `/register`
- **My Stocks:** `/my-stocks` (requires authentication)
- **Hot Stocks:** `/stocks` (public stock prices)

## 📝 Note for Teachers

The application uses **"My Stocks"** in the navigation to access the portfolio management system where IDOR prevention is implemented. Each user can only manage their own stock portfolio, and any attempt to access another user's data will be blocked by the authorization system.

**Test Authentication:** Try accessing `/my-stocks` without logging in - you'll be redirected to login page (access control working).

**Test IDOR:** Try changing stock IDs in URLs when logged in as different users - access will be denied (IDOR prevention working).
