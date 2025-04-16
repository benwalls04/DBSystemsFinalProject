# Employee Points Management System

## Setup Instructions

### Prerequisites
- PHP installed (with MySQL support)
- MySQL Server
- VSCode (recommended, but not required)

### Installation Steps

1. Move the source code into your PHP directory (typically `C:/php`)

2. Database Setup
   - Open the folder in VSCode (recommended)
   - Open a terminal and sign into MySQL
   - In a separate terminal, locate your current working directory
     - If using VSCode, likely `C:/php/DB_proj`
     - Use `cd` or `pwd` to confirm directory location
   - In the MySQL terminal, run:
     ```sql
     source /path/to/your/directory/init.SQL
     ```
     Example: `source C:/php/DB_proj/init.SQL`
   
   This creates the database GP1 with the following tables:
   - EMPLOYEE_GP1
   - MANAGER_GP1
   - PRODUCT_GP1
   - TRANSACTION_GP1
   - BALANCE_GP1

3. Start PHP Server
   - In your second terminal
   - Run the command:
     ```bash
     ../php -S localhost:8080
     ```
   - Or if your terminal is already in the php directory, run:
     ```bash
     php -S localhost:8080
     ```

4. Access Application
   - Open your browser
   - Navigate to: `localhost:8080/index.php`
   - Or if you ran the php -S command in the php directory, navigate to: `localhost:8080/DB_proj/index.php`

# Team Contribution Summary

## Project: Employee Points Management System

### Team Members and Contributions:

1. **Ben** - Manager Interface
   - Developed the complete manager dashboard
   - Implemented employee management functionality (add/delete employees)
   - Created product management system (add/edit/delete products)
   - Implemented points award system
   - Handled manager authentication and session management
   - Developed database queries for manager operations

2. **Bela** - Authentication and Employee Interface
   - Created the login system and user authentication
   - Developed the employee dashboard
   - Implemented points redemption system
   - Created transaction history viewing
   - Added date filtering for transactions
   - Handled employee session management
   - Developed database queries for employee operations

3. **Lyna** - UI/UX Design and Styling
   - Created the CSS styling framework
   - Implemented responsive design
   - Standardized the visual appearance across all pages
   - Styled forms and tables
   - Added navigation elements
   - Created error message styling
   - Ensured consistent layout and user experience

### Project Structure:
- Database design and initialization was a collaborative effort
- Code integration and testing was performed by all team members
- Documentation was maintained throughout development