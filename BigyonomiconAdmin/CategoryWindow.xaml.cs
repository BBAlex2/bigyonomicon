using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;

namespace BigyonomiconAdmin
{
    /// <summary>
    /// Interaction logic for CategoryWindow.xaml
    /// </summary>
    public partial class CategoryWindow : Window
    {
        private readonly HttpClient _httpClient;
        private readonly string _baseUrl = "http://127.0.0.1:8000/api/";
        private bool _isEditMode;

        public Category Category { get; private set; }

        public CategoryWindow(Category category = null)
        {
            InitializeComponent();
            _httpClient = new HttpClient();
            _httpClient.BaseAddress = new Uri(_baseUrl);

            if (category != null)
            {
                _isEditMode = true;
                Category = category;
                LoadCategoryData();
            }
            else
            {
                _isEditMode = false;
                Category = new Category();
            }

            LoadMainCategories();
        }

        private void LoadCategoryData()
        {
            txtId.Text = Category.id.ToString();
            txtName.Text = Category.name;
            
            if (Category.type == "main")
            {
                cmbType.SelectedIndex = 0;
            }
            else if (Category.type == "sub")
            {
                cmbType.SelectedIndex = 1;
                lblParentCategory.Visibility = Visibility.Visible;
                cmbParentCategory.Visibility = Visibility.Visible;
            }
        }

        private async void LoadMainCategories()
        {
            try
            {
                var response = await _httpClient.GetAsync("categories");
                if (response.IsSuccessStatusCode)
                {
                    var content = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<List<Category>>>(content);
                    
                    if (apiResponse.success)
                    {
                        cmbParentCategory.ItemsSource = apiResponse.data;
                        
                        if (_isEditMode && Category.parent_id.HasValue)
                        {
                            cmbParentCategory.SelectedValue = Category.parent_id.Value;
                        }
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Error loading main categories: {ex.Message}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private void cmbType_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (cmbType.SelectedItem is ComboBoxItem selectedItem)
            {
                string type = selectedItem.Tag.ToString();
                
                if (type == "sub")
                {
                    lblParentCategory.Visibility = Visibility.Visible;
                    cmbParentCategory.Visibility = Visibility.Visible;
                }
                else
                {
                    lblParentCategory.Visibility = Visibility.Collapsed;
                    cmbParentCategory.Visibility = Visibility.Collapsed;
                }
            }
        }

        private void btnCancel_Click(object sender, RoutedEventArgs e)
        {
            DialogResult = false;
            Close();
        }

        private void btnSave_Click(object sender, RoutedEventArgs e)
        {
            if (ValidateInput())
            {
                SaveCategory();
                DialogResult = true;
                Close();
            }
        }

        private bool ValidateInput()
        {
            if (string.IsNullOrWhiteSpace(txtName.Text))
            {
                MessageBox.Show("Name is required.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            if (cmbType.SelectedItem == null)
            {
                MessageBox.Show("Please select a type.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            string type = ((ComboBoxItem)cmbType.SelectedItem).Tag.ToString();
            if (type == "sub" && cmbParentCategory.SelectedItem == null)
            {
                MessageBox.Show("Please select a parent category.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            return true;
        }

        private void SaveCategory()
        {
            if (_isEditMode)
            {
                Category.id = int.Parse(txtId.Text);
            }

            Category.name = txtName.Text;
            Category.type = ((ComboBoxItem)cmbType.SelectedItem).Tag.ToString();
            
            if (Category.type == "sub")
            {
                Category.parent_id = (int)cmbParentCategory.SelectedValue;
            }
            else
            {
                Category.parent_id = null;
            }
        }
    }
}
