   M S B A M L   `   `   `  ����L  HBigyonomiconAdmin, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null5clr-namespace:BigyonomiconAdminBigyonomiconAdmin  5   	   %    BigyonomiconAdmin.ProductWindow   5   	   W SPresentationCore, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35\ XPresentationFramework, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35e aSystem.Windows.Controls.Ribbon, Version=6.0.2.0, Culture=neutral, PublicKeyToken=b77a5c561934e089R NWindowsBase, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35F 9http://schemas.microsoft.com/winfx/2006/xaml/presentation     5   	   R NSystem.Xaml, Version=6.0.2.0, Culture=neutral, PublicKeyToken=b77a5c561934e089:x,http://schemas.microsoft.com/winfx/2006/xaml     5   	   @d2http://schemas.microsoft.com/expression/blend/2008     5   	   Jmc;http://schemas.openxmlformats.org/markup-compatibility/2006     5   	   1localclr-namespace:BigyonomiconAdmin     5   	     � Title$  Product Details��5   	   $	��600��6!   $	��800��6.    � WindowStartupLocation$ CenterOwner=�6:   .��5	      � $��20q�6    � RowDefinitions 5
   
   �� 5      $
��Auto �6   �� 5      $��* �6   �� 5      $
��Auto �6   .+�5   
   �� $��0��6   $��Product Details��6!   $��24(�68   $
��Bold"�6F   $��0,0,0,20q�6X   �� 5   
   $��1��6   $
��Auto=�6$   .��5      �� .+�5      �� $	��ID:��6   $��0,10,0,5q�6'   $
��Bold"�69   �� 5      -   5         ��Name$ txtId��5       �� 
IsReadOnly$
 True��6)   $��0,0,0,10q�6;   �� 5      $��Name:��6   $��0,10,0,5q�6)   $
��Bold"�6;   �� 5      -   5        $ txtName��5      $��0,0,0,10q�6+   �� 5      $��Description:��6   $��0,10,0,5q�60   $
��Bold"�6B   �� 5      -   5        $ txtDescription��5       �� TextWrapping$
 Wrap=�62    �� AcceptsReturn$
 True��6F   $	��100��6[   $��0,0,0,10q�6h   �� 5      $��Price:��6   $��0,10,0,5q�6*   $
��Bold"�6<   �� 5      -   5        $ txtPrice��5      $��0,0,0,10q�6,   �� 5       $��Image:��6   $��0,10,0,5q�6*   $
��Bold"�6<   �� 5!      -   5        $ txtImage��5!      $��0,0,0,10q�6,   �� 5#      $��Option2 Image:��6   $��0,10,0,5q�62   $
��Bold"�6D   �� 5$      -   5        $ txtOption2Image��5$      $��0,0,0,10q�63   �� 5&      $��Rating:��6   $��0,10,0,5q�6+   $
��Bold"�6=   �� 5'      -   5        $ 	txtRating��5'      $��0,0,0,10q�6-   �� 5)      $��Rating Count:��6   $��0,10,0,5q�61   $
��Bold"�6C   �� 5*      -   5        $ txtRatingCount��5*      $��0,0,0,10q�62   �� 5,      $��	Category:��6   $��0,10,0,5q�6-   $
��Bold"�6?   �� 5-      -	   5         ��Name$ cmbCategory��5-       �� DisplayMemberPath$
 name��60   	 �� SelectedValuePath$	 id��6I   $��0,0,0,10q�6`   6r   �� 5/      $��Subcategory:��6   $��0,10,0,5q�60   $
��Bold"�6B   �� 50      -
   5        $ cmbSubcategory��50      $
 name��63   $	 id��6L   $��0,0,0,10q�6c   51      52      �� 54   
   $��2��6   
 �� Orientation$
 
Horizontal=�6"   $��Right=�6;   $��0,20,0,0q�6W   .+�55      �� -   5         ��Name$ 	btnCancel��55      $��Cancel��6(   $	��100��69   $��0,0,10,0q�6E   6W   �� 56      -   5        $ btnSave��56      $
��Save��6&   $	��100��65   6A   57      58      59      