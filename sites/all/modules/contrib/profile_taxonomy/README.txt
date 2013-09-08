Profile Taxonomy README
--------------------------------------------------

Profile Taxonomy enables the assignment of taxonomy terms to user profiles. Site administrators can reference
a vocabulary from a list selection user profile field. Then users can choose the populated taxonomy terms from 
the user profile pages or registration form.

This module builds on top of the list selection profile field making its data source, i. e. option list, dynamic
by referencing taxonomy terms. This elegant masquerading makes Profile Taxonomy compatible with various
themes and other modules, e. g. Views, Apache Solr Search Integration or other user profile related modules. 


Recommendations
---------------

- Profile Checkboxes (profile_checkboxes): Associate multiple terms with a profile list selection field
- Profile Role (profile_role): Restrict visibilty of user categories (and their contained fields) by user roles


Limitations
-----------

The list selection profile field can only store term names, but not the term ids. When updating taxonomy terms
its names have to be unique within a vocabulary, otherwise already selected terms won't be refreshed correctly.


Installation & Administration
-----------------------------

1. Enable the module and its dependent modules
2. Go to User Management->Profile (URL: admin/user/profile) 
3. Add/edit a field of the type "list selection"
4. Select a vocabulary from the fieldset "Selection options from vocabulary (advanced)" 
5. Edit the extra settings within the same fieldset as you prefer
6. Save the administration form


Usage
---------------------------------------------------

1. Go to the user editing pages or to the user registration form
2. Select a value from the field
3. Finally save/register the user profile