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
    /// Interaction logic for ProductWindow.xaml
    /// </summary>
    public partial class ProductWindow : Window
    {
        private readonly HttpClient _httpClient;
        private readonly string _baseUrl = "http://127.0.0.1:8000/api/";
        private bool _isEditMode;

        public Product Product { get; private set; }

        public ProductWindow(Product product = null)
        {
            InitializeComponent();
            _httpClient = new HttpClient();
            _httpClient.BaseAddress = new Uri(_baseUrl);

            if (product != null)
            {
                _isEditMode = true;
                Product = product;
                LoadProductData();
            }
            else
            {
                _isEditMode = false;
                Product = new Product();
            }

            LoadCategories();
        }

        private void LoadProductData()
        {
            txtId.Text = Product.id.ToString();
            txtName.Text = Product.name;
            txtDescription.Text = Product.description;
            txtPrice.Text = Product.price.ToString();
            txtImage.Text = Product.image;
            txtOption2Image.Text = Product.option2_image;
            txtRating.Text = Product.rating.ToString();
            txtRatingCount.Text = Product.rating_count.ToString();
        }

        private async void LoadCategories()
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
                        cmbCategory.ItemsSource = apiResponse.data;
                        
                        if (_isEditMode)
                        {
                            cmbCategory.SelectedValue = Product.category_id;
                            LoadSubcategories(Product.category_id);
                        }
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Error loading categories: {ex.Message}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void LoadSubcategories(int categoryId)
        {
            try
            {
                var response = await _httpClient.GetAsync($"categories/{categoryId}/subcategories");
                if (response.IsSuccessStatusCode)
                {
                    var content = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<List<Category>>>(content);
                    
                    if (apiResponse.success)
                    {
                        cmbSubcategory.ItemsSource = apiResponse.data;
                        
                        if (_isEditMode)
                        {
                            cmbSubcategory.SelectedValue = Product.subcategory_id;
                        }
                    }
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Error loading subcategories: {ex.Message}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private void cmbCategory_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            if (cmbCategory.SelectedItem is Category selectedCategory)
            {
                LoadSubcategories(selectedCategory.id);
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
                SaveProduct();
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

            if (string.IsNullOrWhiteSpace(txtDescription.Text))
            {
                MessageBox.Show("Description is required.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            if (!decimal.TryParse(txtPrice.Text, out decimal price) || price < 0)
            {
                MessageBox.Show("Price must be a valid number greater than or equal to 0.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            if (!string.IsNullOrWhiteSpace(txtRating.Text) && (!decimal.TryParse(txtRating.Text, out decimal rating) || rating < 0 || rating > 10))
            {
                MessageBox.Show("Rating must be a valid number between 0 and 10.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            if (!string.IsNullOrWhiteSpace(txtRatingCount.Text) && (!int.TryParse(txtRatingCount.Text, out int ratingCount) || ratingCount < 0))
            {
                MessageBox.Show("Rating count must be a valid number greater than or equal to 0.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            if (cmbCategory.SelectedItem == null)
            {
                MessageBox.Show("Please select a category.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            if (cmbSubcategory.SelectedItem == null)
            {
                MessageBox.Show("Please select a subcategory.", "Validation Error", MessageBoxButton.OK, MessageBoxImage.Warning);
                return false;
            }

            return true;
        }

        private void SaveProduct()
        {
            if (_isEditMode)
            {
                Product.id = int.Parse(txtId.Text);
            }

            Product.name = txtName.Text;
            Product.description = txtDescription.Text;
            Product.price = decimal.Parse(txtPrice.Text);
            Product.image = txtImage.Text;
            Product.option2_image = txtOption2Image.Text;
            
            if (!string.IsNullOrWhiteSpace(txtRating.Text))
            {
                Product.rating = decimal.Parse(txtRating.Text);
            }
            
            if (!string.IsNullOrWhiteSpace(txtRatingCount.Text))
            {
                Product.rating_count = int.Parse(txtRatingCount.Text);
            }
            
            Product.category_id = (int)cmbCategory.SelectedValue;
            Product.subcategory_id = (int)cmbSubcategory.SelectedValue;
        }
    }
}
