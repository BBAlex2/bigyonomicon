   M S B A M L   `   `   `  ����L  HBigyonomiconAdmin, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null5clr-namespace:BigyonomiconAdminBigyonomiconAdmin  5   	   "    BigyonomiconAdmin.MainWindow   5   	   W SPresentationCore, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35\ XPresentationFramework, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35e aSystem.Windows.Controls.Ribbon, Version=6.0.2.0, Culture=neutral, PublicKeyToken=b77a5c561934e089R NWindowsBase, Version=6.0.2.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35F 9http://schemas.microsoft.com/winfx/2006/xaml/presentation     5   	   R NSystem.Xaml, Version=6.0.2.0, Culture=neutral, PublicKeyToken=b77a5c561934e089:x,http://schemas.microsoft.com/winfx/2006/xaml     5   	   @d2http://schemas.microsoft.com/expression/blend/2008     5   	   Jmc;http://schemas.openxmlformats.org/markup-compatibility/2006     5   	   1localclr-namespace:BigyonomiconAdmin     5   	     � Title$  Bigyonomicon Admin��5   	   $	��600��6$   $
��1000��61   .��5	      �  � RowDefinitions 5
   
   �� 5      $
��Auto �6   �� 5      $��* �6   .+�5   
   �� $��0��6    �� Orientation$ 
Horizontal=�6"   $��10q�6;   .+�5      �� $��Bigyonomicon Admin Panel��6   $��24(�68   $
��Bold"�6F   $��0,0,20,0q�6X   �� 5      -   5         ��Name$ btnProducts��5      $��Products��6*   $	��100��6=   $��5q�6I   6T   �� 5      -   5        $ btnCategories��5      $��
Categories��6,   $	��100��6A   $��5q�6M   6X   5      �� 5   
   -   5         ��Name$ 
tabControl��5   "   $��1��6   $��10q�66   .@�5      �� -   5         ��Name$ tabProducts��5   (   $��Products��6   .��5      �  5      �� 5      $
��Auto �6(   �� 5      $��* �6(   �� 5      $
��Auto �6(   .+�5      �� $��0��6!   $ 
Horizontal=�6.   $��0,0,0,10q�6G   .+�5      �� -   5        $ btnRefreshProducts��5   !   $��Refresh��6=   $	��100��6O   $��5q�6[   6f   �� 5       -   5        $ btnAddProduct��5    !   $��Add New��68   $	��100��6J   $��5q�6V   6a   �� 5!      -   5        $ btnEditProduct��5!   !   $
��Edit��69   $	��100��6H   $��5q�6T   6_   �� 5"      -   5        $ btnDeleteProduct��5"   !   $��Delete��6;   $	��100��6L   $��5q�6X   6c   5#      &   System.Windows.Controls.DataGrid  5%      -	   5          Name$ 
dgProducts��5%   ,   $��1��6      AutoGenerateColumns$ False��6@      
IsReadOnly$
 True��6\   	   SelectionMode$	 Single=�6n   
   Columns
 5&      0  *System.Windows.Controls.DataGridTextColumn  5'      ,  &System.Windows.Controls.DataGridColumn   Header$ ID��61      Width5  /System.Windows.Controls.DataGridLengthConverter$ 50 6T   1  +System.Windows.Controls.DataGridBoundColumn   Binding 6=   �� *id+6T     5(      $
 Name��61   $	 200 6X    6?   �� *name+6X     5)      $ Price��61   $	 100 6Z    6@   �� *price+6Z     5*      $ Category��61   $	 150 6e    6C   �� *category.name+6e     5+      $ Subcategory��61   $	 150 6k    6F   �� *subcategory.name+6k     5,      $ Rating��61   $	 100 6\    6A   �� *rating+6\   5.      �� 50      $��2��6!   $��0,10,0,0q�6.   .+�51      �� -
   5         ��Name$ txtProductStatus��51   $   
��� � �6>   52      53      54      �� 56      -   5        $ tabCategories��56   *   $��
Categories��6   .��57      �  58      �� 59      $
��Auto �6(   �� 5:      $��* �6(   �� 5;      $
��Auto �6(   .+�5>      �� $��0��6!   $ 
Horizontal=�6.   $��0,0,0,10q�6G   .+�5?      �� -   5        $ btnRefreshCategories��5?   !   $��Refresh��6?   $	��100��6Q   $��5q�6]   6h   �� 5@      -   5        $ btnAddCategory��5@   !   $��Add New��69   $	��100��6K   $��5q�6W   6b   �� 5A      -   5        $ btnEditCategory��5A   !   $
��Edit��6:   $	��100��6I   $��5q�6U   6`   �� 5B      -   5        $ btnDeleteCategory��5B   !   $��Delete��6<   $	��100��6M   $��5q�6Y   6d   5C        5E      -   5        $ dgCategories��5E   ,   $��1��6   $ False��6B   $
 True��6^   $	 Single=�6p   
 5F        5G      $ ID��61   $ 50 6T    6=   �� *id+6T     5H      $
 Name��61   $	 200 6X    6?   �� *name+6X     5I      $
 Type��61   $	 100 6X    6?   �� *type+6X     5J      $ 	Parent ID��61   $	 100 6b    6D   �� *	parent_id+6b   5L      �� 5N      $��2��6!   $��0,10,0,0q�6.   .+�5O      �� -   5        $ txtCategoryStatus��5O   $   
��� � �6?   5P      5Q      5R      5S      5T      5U      