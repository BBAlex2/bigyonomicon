   M S B A M L   `   `   `  ����L  HBigyonomiconAdmin, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null5clr-namespace:BigyonomiconAdminBigyonomiconAdmin  5   	   &     BigyonomiconAdmin.CategoryWindow   5   	   W SPresentationCore, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35\ XPresentationFramework, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35e aSystem.Windows.Controls.Ribbon, Version=6.0.2.0, Culture=neutral, PublicKeyToken=b77a5c561934e089R NWindowsBase, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35F 9http://schemas.microsoft.com/winfx/2006/xaml/presentation     5   	   R NSystem.Xaml, Version=6.0.2.0, Culture=neutral, PublicKeyToken=b77a5c561934e089:x,http://schemas.microsoft.com/winfx/2006/xaml     5   	   @d2http://schemas.microsoft.com/expression/blend/2008     5   	   Jmc;http://schemas.openxmlformats.org/markup-compatibility/2006     5   	   1localclr-namespace:BigyonomiconAdmin     5   	     � Title$  Category Details��5   	   $	��400��6"   $	��600��6/    � WindowStartupLocation$ CenterOwner=�6;   .��5	      � $��20q�6    � RowDefinitions 5
   
   �� 5      $
��Auto �6   �� 5      $��* �6   �� 5      $
��Auto �6   .+�5   
   �� $��0��6   $��Category Details��6!   $��24(�69   $
��Bold"�6G   $��0,0,0,20q�6Y   �� 5   
   $��1��6   .+�5      �� $	��ID:��6   $��0,10,0,5q�6#   $
��Bold"�65   �� 5      -   5         ��Name$ txtId��5       �� 
IsReadOnly$
 True��6%   $��0,0,0,10q�67   �� 5      $��Name:��6   $��0,10,0,5q�6%   $
��Bold"�67   �� 5      -   5        $ txtName��5      $��0,0,0,10q�6'   �� 5      $��Type:��6   $��0,10,0,5q�6%   $
��Bold"�67   �� 5      -   5         ��Name$ cmbType��5      $��0,0,0,10q�6(   .@�5      �� $��Main Category��6   
 � Tag$
 main��67   �� 5      $��Subcategory��6   $	 sub��65   5      �� 5      -   5         ��Name$ lblParentCategory��5      $��Parent Category:��63   $��0,10,0,5q�6K   $
��Bold"�6]   $y�	Collapsed=�6o   �� 5       -   5        $ cmbParentCategory��5        �� DisplayMemberPath$
 name��62   	 �� SelectedValuePath$	 id��6K   $��0,0,0,10q�6b   $y�	Collapsed=�6t   5!      �� 5#   
   $��2��6   
 �� Orientation$
 
Horizontal=�6"   $��Right=�6;   $��0,20,0,0q�6W   .+�5$      �� -   5         ��Name$ 	btnCancel��5$      $��Cancel��6(   $	��100��69   $��0,0,10,0q�6E   6W   �� 5%      -   5        $ btnSave��5%      $
��Save��6&   $	��100��65   6A   5&      5'      5(      