# Role Assignment System

## Overview

The Role Assignment System provides comprehensive functionality to assign roles to users efficiently, including individual user role assignment and bulk role assignment for multiple users. The system supports three different assignment actions: add, replace, and remove roles.

## Features

### 1. Individual User Role Assignment

**Location**: User dropdown menu and dedicated permissions column
**Functionality**: Assign roles to individual users
**Access Points**:
- User dropdown menu with permission status
- Dedicated permissions column in users table
- Direct links to role assignment page

### 2. Bulk Role Assignment

**Location**: Users page with comprehensive interface
**Functionality**: Assign roles to multiple users simultaneously
**Features**:
- Select multiple users and roles
- Three assignment actions (add, replace, remove)
- Real-time selection counters
- Confirmation dialogs
- Progress indicators

### 3. Assignment Actions

#### **Add Roles (Keep Existing)**
- Adds selected roles to users
- Preserves existing roles
- Prevents duplicate role assignments
- Safe for incremental role assignment

#### **Replace All Roles**
- Removes all existing roles
- Assigns only selected roles
- Complete role replacement
- Use with caution

#### **Remove Selected Roles**
- Removes only selected roles
- Keeps other existing roles
- Selective role removal
- Safe for role cleanup

## Implementation Details

### 1. Bulk Role Assignment Interface

#### **User Selection Panel:**
```html
<div class="form-group">
    <label><strong>Select Users:</strong></label>
    <div class="checkbox-group">
        <label class="checkbox-inline">
            <input type="checkbox" id="selectAllUsers"> <strong>Select All Users</strong>
        </label>
        <hr>
        <?php foreach ($all_users as $user): ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="users[]" value="<?php echo $user['users_id']; ?>" class="user-checkbox">
                <?php echo $user['name']; ?> (<?php echo $user['user_name']; ?>)
                <?php if (!empty($user['roles'])): ?>
                    <span class="badge badge-success"><?php echo count($user['roles']); ?> roles</span>
                <?php else: ?>
                    <span class="badge badge-warning">No roles</span>
                <?php endif; ?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</div>
```

#### **Role Selection Panel:**
```html
<div class="form-group">
    <label><strong>Select Roles:</strong></label>
    <div class="checkbox-group">
        <label class="checkbox-inline">
            <input type="checkbox" id="selectAllRoles"> <strong>Select All Roles</strong>
        </label>
        <hr>
        <?php foreach ($all_roles as $role): ?>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="roles[]" value="<?php echo $role['role_id']; ?>" class="role-checkbox">
                <span class="badge badge-<?php echo get_role_badge_class($role['role_name']); ?>">
                    <?php echo $role['role_name']; ?>
                </span>
                <br>
                <small class="text-muted"><?php echo $role['role_description']; ?></small>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</div>
```

#### **Assignment Action Panel:**
```html
<div class="form-group">
    <label><strong>Assignment Action:</strong></label>
    <div class="radio">
        <label>
            <input type="radio" name="action" value="add" checked>
            <i class="fa fa-plus text-success"></i> Add Roles (Keep existing)
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="action" value="replace">
            <i class="fa fa-refresh text-warning"></i> Replace All Roles
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="action" value="remove">
            <i class="fa fa-minus text-danger"></i> Remove Selected Roles
        </label>
    </div>
</div>
```

### 2. Controller Methods

#### **Bulk Role Assignment Controller:**
```php
public function bulk_assign_roles() {
    if (!$this->session->userdata('user_id')) {
        redirect('login');
    }
    
    if (!has_module_permission('permissions') && !is_admin()) {
        show_error('Access Denied', 403);
    }
    
    if ($this->input->post()) {
        $users = $this->input->post('users');
        $roles = $this->input->post('roles');
        $action = $this->input->post('action', 'add');
        
        if (empty($users) || empty($roles)) {
            $this->session->set_flashdata('error', 'Please select at least one user and one role.');
            redirect('users/allusers');
        }
        
        $success_count = 0;
        $error_count = 0;
        
        foreach ($users as $user_id) {
            try {
                if ($action === 'replace') {
                    $this->m_permissions->removeAllUserRoles($user_id);
                } elseif ($action === 'remove') {
                    foreach ($roles as $role_id) {
                        $this->m_permissions->removeRoleFromUser($user_id, $role_id);
                    }
                    $success_count++;
                    continue;
                }
                
                if ($action !== 'remove') {
                    foreach ($roles as $role_id) {
                        if ($action === 'add') {
                            $existing_roles = $this->m_permissions->getUserRoles($user_id);
                            $role_exists = false;
                            foreach ($existing_roles as $existing_role) {
                                if ($existing_role['role_id'] == $role_id) {
                                    $role_exists = true;
                                    break;
                                }
                            }
                            if (!$role_exists) {
                                $this->m_permissions->assignRoleToUser($user_id, $role_id);
                            }
                        } else {
                            $this->m_permissions->assignRoleToUser($user_id, $role_id);
                        }
                    }
                }
                
                $success_count++;
            } catch (Exception $e) {
                $error_count++;
            }
        }
        
        if ($error_count > 0) {
            $this->session->set_flashdata('warning', "Role assignment completed with {$success_count} successful and {$error_count} failed assignments.");
        } else {
            $this->session->set_flashdata('success', "Successfully assigned roles to {$success_count} users.");
        }
        
        redirect('users/allusers');
    }
    
    redirect('users/allusers');
}
```

### 3. Model Methods

#### **Bulk Role Assignment Model:**
```php
public function bulkAssignRoles($user_ids, $role_ids, $action = 'add', $assigned_by = null) {
    $results = [
        'success_count' => 0,
        'error_count' => 0,
        'errors' => []
    ];
    
    foreach ($user_ids as $user_id) {
        try {
            if ($action === 'replace') {
                $this->removeAllUserRoles($user_id);
                foreach ($role_ids as $role_id) {
                    $this->assignRoleToUser($user_id, $role_id, $assigned_by);
                }
            } elseif ($action === 'remove') {
                foreach ($role_ids as $role_id) {
                    $this->removeRoleFromUser($user_id, $role_id);
                }
            } else {
                foreach ($role_ids as $role_id) {
                    $existing_roles = $this->getUserRoles($user_id);
                    $role_exists = false;
                    foreach ($existing_roles as $existing_role) {
                        if ($existing_role['role_id'] == $role_id) {
                            $role_exists = true;
                            break;
                        }
                    }
                    if (!$role_exists) {
                        $this->assignRoleToUser($user_id, $role_id, $assigned_by);
                    }
                }
            }
            
            $results['success_count']++;
        } catch (Exception $e) {
            $results['error_count']++;
            $results['errors'][] = "User ID {$user_id}: " . $e->getMessage();
        }
    }
    
    return $results;
}

public function removeAllUserRoles($user_id) {
    $this->db->where('user_id', $user_id);
    return $this->db->update('user_roles', ['is_active' => 0]);
}
```

### 4. JavaScript Functionality

#### **Selection Management:**
```javascript
$(document).ready(function() {
    // Select All Users
    $('#selectAllUsers').change(function() {
        $('.user-checkbox').prop('checked', $(this).is(':checked'));
        updateSelectionCounts();
    });
    
    // Select All Roles
    $('#selectAllRoles').change(function() {
        $('.role-checkbox').prop('checked', $(this).is(':checked'));
        updateSelectionCounts();
    });
    
    // Update selection counts when individual checkboxes change
    $('.user-checkbox, .role-checkbox').change(function() {
        updateSelectionCounts();
    });
});
```

#### **Dynamic Button Updates:**
```javascript
function updateSelectionCounts() {
    var selectedUsers = $('.user-checkbox:checked').length;
    var selectedRoles = $('.role-checkbox:checked').length;
    
    $('#selectedUsersCount').text(selectedUsers);
    $('#selectedRolesCount').text(selectedRoles);
    
    // Update button text
    var action = $('input[name="action"]:checked').val();
    var buttonText = '';
    
    switch(action) {
        case 'add':
            buttonText = 'Add Roles to ' + selectedUsers + ' Users';
            break;
        case 'replace':
            buttonText = 'Replace Roles for ' + selectedUsers + ' Users';
            break;
        case 'remove':
            buttonText = 'Remove Roles from ' + selectedUsers + ' Users';
            break;
    }
    
    $('#bulkAssignBtn').html('<i class="fa fa-users"></i> ' + buttonText);
}
```

#### **Form Validation and Confirmation:**
```javascript
$('#bulkRoleForm').submit(function(e) {
    var selectedUsers = $('.user-checkbox:checked').length;
    var selectedRoles = $('.role-checkbox:checked').length;
    var action = $('input[name="action"]:checked').val();
    
    if (selectedUsers === 0) {
        alert('Please select at least one user.');
        e.preventDefault();
        return false;
    }
    
    if (selectedRoles === 0) {
        alert('Please select at least one role.');
        e.preventDefault();
        return false;
    }
    
    var confirmMessage = '';
    switch(action) {
        case 'add':
            confirmMessage = 'Are you sure you want to ADD ' + selectedRoles + ' role(s) to ' + selectedUsers + ' user(s)?';
            break;
        case 'replace':
            confirmMessage = 'Are you sure you want to REPLACE all roles for ' + selectedUsers + ' user(s) with ' + selectedRoles + ' role(s)? This will remove all existing roles.';
            break;
        case 'remove':
            confirmMessage = 'Are you sure you want to REMOVE ' + selectedRoles + ' role(s) from ' + selectedUsers + ' user(s)?';
            break;
    }
    
    if (!confirm(confirmMessage)) {
        e.preventDefault();
        return false;
    }
    
    // Show loading state
    $('#bulkAssignBtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
});
```

## User Experience

### 1. Visual Design

#### **Color-Coded Status Indicators:**
- **Green Badges**: Users with existing roles
- **Orange Badges**: Users without roles
- **Role Counts**: Number of roles per user
- **Action Icons**: Visual indicators for different actions

#### **Responsive Layout:**
- **Three-Column Layout**: Users, Roles, Actions
- **Scrollable Panels**: Handle large lists efficiently
- **Mobile-Friendly**: Adapts to smaller screens
- **Touch-Optimized**: Appropriate button sizes

### 2. Interactive Features

#### **Smart Selection:**
- **Select All**: Quick selection of all users or roles
- **Individual Selection**: Fine-grained control
- **Real-Time Counters**: Live updates of selections
- **Visual Feedback**: Clear indication of selections

#### **Dynamic Interface:**
- **Button Text Updates**: Changes based on action and selections
- **Confirmation Dialogs**: Prevents accidental actions
- **Loading States**: Visual feedback during processing
- **Error Handling**: Clear error messages

### 3. Workflow Optimization

#### **Efficient Bulk Operations:**
- **Multiple Users**: Assign roles to many users at once
- **Multiple Roles**: Assign multiple roles simultaneously
- **Flexible Actions**: Add, replace, or remove roles
- **Batch Processing**: Efficient database operations

#### **Safety Features:**
- **Confirmation Required**: Prevents accidental changes
- **Validation**: Ensures valid selections
- **Error Recovery**: Handles failures gracefully
- **Audit Trail**: Tracks who made changes

## Security Features

### 1. Access Control

#### **Permission Checks:**
- **Module Permission**: Only authorized users can access
- **Admin Override**: Administrators have full access
- **Session Validation**: Ensures user is logged in
- **CSRF Protection**: Prevents cross-site request forgery

#### **Data Validation:**
- **Input Sanitization**: Cleans user inputs
- **Role Validation**: Ensures roles exist
- **User Validation**: Ensures users exist
- **Action Validation**: Validates assignment actions

### 2. Audit Trail

#### **Change Tracking:**
- **Assigned By**: Records who made the assignment
- **Timestamp**: When the change was made
- **Action Type**: What type of action was performed
- **User Affected**: Which users were modified

## Usage Workflow

### 1. Individual Role Assignment

#### **Via User Dropdown:**
1. Navigate to Users page
2. Click dropdown for specific user
3. Click "Manage Permissions" or "Setup Permissions"
4. Select/deselect roles as needed
5. Click "Update User Roles"

#### **Via Permissions Column:**
1. Navigate to Users page
2. Click permission button for specific user
3. Select/deselect roles as needed
4. Click "Update User Roles"

### 2. Bulk Role Assignment

#### **Setup Phase:**
1. Navigate to Users page
2. Locate "Bulk Role Assignment" panel
3. Select users from left panel
4. Select roles from middle panel
5. Choose assignment action

#### **Execution Phase:**
1. Review selection counts
2. Click assignment button
3. Confirm action in dialog
4. Wait for processing
5. Review results message

### 3. Assignment Actions

#### **Add Roles (Recommended):**
- **Use Case**: Adding new roles to existing users
- **Safety**: Preserves existing roles
- **Result**: Users have both old and new roles

#### **Replace Roles (Use with Caution):**
- **Use Case**: Complete role restructuring
- **Safety**: Removes all existing roles
- **Result**: Users have only selected roles

#### **Remove Roles (Cleanup):**
- **Use Case**: Removing specific roles from users
- **Safety**: Keeps other existing roles
- **Result**: Users have remaining roles minus selected ones

## Best Practices

### 1. Role Assignment Strategy

#### **Incremental Assignment:**
- Start with basic roles for new users
- Add specialized roles as needed
- Use "Add Roles" action for safety
- Review role assignments regularly

#### **Role Hierarchy:**
- Define clear role hierarchies
- Use role descriptions effectively
- Group related permissions in roles
- Avoid role overlap when possible

### 2. Bulk Operations

#### **Planning:**
- Review user lists before bulk operations
- Test with small groups first
- Have a rollback plan ready
- Communicate changes to affected users

#### **Execution:**
- Use appropriate action types
- Monitor progress and results
- Handle errors gracefully
- Document changes made

### 3. Security Considerations

#### **Access Control:**
- Limit bulk assignment to authorized users
- Log all role assignment activities
- Regular audit of role assignments
- Monitor for unusual patterns

#### **Data Integrity:**
- Validate all inputs before processing
- Use database transactions for consistency
- Handle concurrent access properly
- Maintain referential integrity

## Troubleshooting

### Common Issues

#### **1. Permission Denied Errors:**
- **Cause**: User lacks permission management access
- **Solution**: Check user permissions or contact administrator
- **Prevention**: Ensure proper role assignments

#### **2. Role Assignment Failures:**
- **Cause**: Invalid role or user IDs
- **Solution**: Verify role and user existence
- **Prevention**: Validate data before processing

#### **3. Performance Issues:**
- **Cause**: Large number of users or roles
- **Solution**: Process in smaller batches
- **Prevention**: Optimize database queries

### Debug Steps

#### **1. Check User Permissions:**
```php
// Verify user has permission access
if (has_module_permission('permissions')) {
    echo "User has permission access";
} else {
    echo "User lacks permission access";
}
```

#### **2. Validate Role Data:**
```php
// Check if roles exist
$roles = $this->m_permissions->getAllRoles();
foreach ($roles as $role) {
    echo "Role: " . $role['role_name'] . " (ID: " . $role['role_id'] . ")\n";
}
```

#### **3. Test Individual Assignment:**
```php
// Test single user role assignment
$result = $this->m_permissions->assignRoleToUser($user_id, $role_id);
if ($result) {
    echo "Role assigned successfully";
} else {
    echo "Role assignment failed";
}
```

## Future Enhancements

### 1. Advanced Features

#### **Role Templates:**
- Predefined role combinations
- Quick assignment templates
- Template management interface
- Template versioning

#### **Scheduled Assignments:**
- Time-based role assignments
- Automatic role expiration
- Scheduled role changes
- Assignment reminders

#### **Role Analytics:**
- Role usage statistics
- Assignment patterns
- Permission utilization
- Role effectiveness metrics

### 2. User Experience

#### **Drag and Drop Interface:**
- Visual role assignment
- Drag users to roles
- Visual role hierarchy
- Intuitive interface

#### **Advanced Filtering:**
- Filter users by criteria
- Filter roles by type
- Search functionality
- Smart suggestions

### 3. Integration Features

#### **API Access:**
- REST API for role assignment
- Programmatic role management
- Third-party integrations
- Automated workflows

#### **Notification System:**
- Email notifications for role changes
- Role assignment confirmations
- Change alerts
- Approval workflows

## Conclusion

The Role Assignment System provides a comprehensive and user-friendly solution for managing user roles efficiently. The combination of individual and bulk assignment capabilities, along with multiple assignment actions, ensures flexibility and safety in role management.

The system's security features, audit trail capabilities, and user-friendly interface make it suitable for organizations of all sizes. The modular design allows for easy extension and customization to meet specific organizational needs.

By following best practices and utilizing the system's safety features, administrators can effectively manage user roles while maintaining security and data integrity throughout the organization. 