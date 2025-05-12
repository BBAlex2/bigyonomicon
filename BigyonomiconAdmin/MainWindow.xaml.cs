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
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace BigyonomiconAdmin
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        private readonly HttpClient _httpClient;
        private readonly string _baseUrl = "http://127.0.0.1:8000/api/";

        public MainWindow()
        {
            InitializeComponent();
            _httpClient = new HttpClient();
            _httpClient.BaseAddress = new Uri(_baseUrl);

            // Load products by default
            LoadProducts();
        }

        #region Button Click Events

        private void btnProducts_Click(object sender, RoutedEventArgs e)
        {
            tabControl.SelectedItem = tabProducts;
        }

        private void btnCategories_Click(object sender, RoutedEventArgs e)
        {
            tabControl.SelectedItem = tabCategories;
            LoadCategories();
        }

        private void btnRefreshProducts_Click(object sender, RoutedEventArgs e)
        {
            LoadProducts();
        }

        private void btnAddProduct_Click(object sender, RoutedEventArgs e)
        {
            var productWindow = new ProductWindow();
            if (productWindow.ShowDialog() == true)
            {
                AddProduct(productWindow.Product);
            }
        }

        private void btnEditProduct_Click(object sender, RoutedEventArgs e)
        {
            var selectedProduct = dgProducts.SelectedItem as Product;
            if (selectedProduct == null)
            {
                MessageBox.Show("Please select a product to edit.", "No Selection", MessageBoxButton.OK, MessageBoxImage.Warning);
                return;
            }

            var productWindow = new ProductWindow(selectedProduct);
            if (productWindow.ShowDialog() == true)
            {
                UpdateProduct(productWindow.Product);
            }
        }

        private void btnDeleteProduct_Click(object sender, RoutedEventArgs e)
        {
            var selectedProduct = dgProducts.SelectedItem as Product;
            if (selectedProduct == null)
            {
                MessageBox.Show("Please select a product to delete.", "No Selection", MessageBoxButton.OK, MessageBoxImage.Warning);
                return;
            }

            var result = MessageBox.Show($"Are you sure you want to delete the product '{selectedProduct.name}'?", "Confirm Delete", MessageBoxButton.YesNo, MessageBoxImage.Question);
            if (result == MessageBoxResult.Yes)
            {
                DeleteProduct(selectedProduct.id);
            }
        }

        private void btnRefreshCategories_Click(object sender, RoutedEventArgs e)
        {
            LoadCategories();
        }

        private void btnAddCategory_Click(object sender, RoutedEventArgs e)
        {
            var categoryWindow = new CategoryWindow();
            if (categoryWindow.ShowDialog() == true)
            {
                AddCategory(categoryWindow.Category);
            }
        }

        private void btnEditCategory_Click(object sender, RoutedEventArgs e)
        {
            var selectedCategory = dgCategories.SelectedItem as Category;
            if (selectedCategory == null)
            {
                MessageBox.Show("Please select a category to edit.", "No Selection", MessageBoxButton.OK, MessageBoxImage.Warning);
                return;
            }

            var categoryWindow = new CategoryWindow(selectedCategory);
            if (categoryWindow.ShowDialog() == true)
            {
                UpdateCategory(categoryWindow.Category);
            }
        }

        private void btnDeleteCategory_Click(object sender, RoutedEventArgs e)
        {
            var selectedCategory = dgCategories.SelectedItem as Category;
            if (selectedCategory == null)
            {
                MessageBox.Show("Please select a category to delete.", "No Selection", MessageBoxButton.OK, MessageBoxImage.Warning);
                return;
            }

            var result = MessageBox.Show($"Are you sure you want to delete the category '{selectedCategory.name}'?", "Confirm Delete", MessageBoxButton.YesNo, MessageBoxImage.Question);
            if (result == MessageBoxResult.Yes)
            {
                DeleteCategory(selectedCategory.id);
            }
        }

        #endregion

        #region API Methods

        private async void LoadProducts()
        {
            try
            {
                txtProductStatus.Text = "Loading products...";
                var response = await _httpClient.GetAsync("products");
                if (response.IsSuccessStatusCode)
                {
                    var content = await response.Content.ReadAsStringAsync();

                    // Debug: Show raw response
                    MessageBox.Show($"API Response: {content.Substring(0, Math.Min(content.Length, 500))}...", "Debug Info");

                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<List<Product>>>(content);

                    if (apiResponse != null && apiResponse.success)
                    {
                        if (apiResponse.data != null && apiResponse.data.Count > 0)
                        {
                            dgProducts.ItemsSource = apiResponse.data;
                            txtProductStatus.Text = $"Loaded {apiResponse.data.Count} products successfully.";
                        }
                        else
                        {
                            txtProductStatus.Text = "No products found.";
                        }
                    }
                    else
                    {
                        txtProductStatus.Text = "Failed to load products. API response was not successful.";
                        txtProductStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtProductStatus.Text = $"Error: {response.StatusCode}";
                    txtProductStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtProductStatus.Text = $"Error: {ex.Message}";
                txtProductStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void AddProduct(Product product)
        {
            try
            {
                var json = JsonConvert.SerializeObject(product);
                var content = new StringContent(json, Encoding.UTF8, "application/json");

                var response = await _httpClient.PostAsync("products", content);
                if (response.IsSuccessStatusCode)
                {
                    var responseContent = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<Product>>(responseContent);

                    if (apiResponse != null && apiResponse.success)
                    {
                        txtProductStatus.Text = "Product added successfully.";
                        txtProductStatus.Foreground = Brushes.Green;
                        LoadProducts();
                    }
                    else
                    {
                        txtProductStatus.Text = "Failed to add product.";
                        txtProductStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtProductStatus.Text = $"Error: {response.StatusCode}";
                    txtProductStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtProductStatus.Text = $"Error: {ex.Message}";
                txtProductStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void UpdateProduct(Product product)
        {
            try
            {
                var json = JsonConvert.SerializeObject(product);
                var content = new StringContent(json, Encoding.UTF8, "application/json");

                var response = await _httpClient.PutAsync($"products/{product.id}", content);
                if (response.IsSuccessStatusCode)
                {
                    var responseContent = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<Product>>(responseContent);

                    if (apiResponse != null && apiResponse.success)
                    {
                        txtProductStatus.Text = "Product updated successfully.";
                        txtProductStatus.Foreground = Brushes.Green;
                        LoadProducts();
                    }
                    else
                    {
                        txtProductStatus.Text = "Failed to update product.";
                        txtProductStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtProductStatus.Text = $"Error: {response.StatusCode}";
                    txtProductStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtProductStatus.Text = $"Error: {ex.Message}";
                txtProductStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void DeleteProduct(int id)
        {
            try
            {
                var response = await _httpClient.DeleteAsync($"products/{id}");
                if (response.IsSuccessStatusCode)
                {
                    var content = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<object>>(content);

                    if (apiResponse != null && apiResponse.success)
                    {
                        txtProductStatus.Text = "Product deleted successfully.";
                        txtProductStatus.Foreground = Brushes.Green;
                        LoadProducts();
                    }
                    else
                    {
                        txtProductStatus.Text = "Failed to delete product.";
                        txtProductStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtProductStatus.Text = $"Error: {response.StatusCode}";
                    txtProductStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtProductStatus.Text = $"Error: {ex.Message}";
                txtProductStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void LoadCategories()
        {
            try
            {
                txtCategoryStatus.Text = "Loading categories...";
                var response = await _httpClient.GetAsync("categories");
                if (response.IsSuccessStatusCode)
                {
                    var content = await response.Content.ReadAsStringAsync();

                    // Debug: Show raw response
                    MessageBox.Show($"API Response: {content.Substring(0, Math.Min(content.Length, 500))}...", "Debug Info");

                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<List<Category>>>(content);

                    if (apiResponse != null && apiResponse.success)
                    {
                        if (apiResponse.data != null && apiResponse.data.Count > 0)
                        {
                            dgCategories.ItemsSource = apiResponse.data;
                            txtCategoryStatus.Text = $"Loaded {apiResponse.data.Count} categories successfully.";
                        }
                        else
                        {
                            txtCategoryStatus.Text = "No categories found.";
                        }
                    }
                    else
                    {
                        txtCategoryStatus.Text = "Failed to load categories. API response was not successful.";
                        txtCategoryStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtCategoryStatus.Text = $"Error: {response.StatusCode}";
                    txtCategoryStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtCategoryStatus.Text = $"Error: {ex.Message}";
                txtCategoryStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void AddCategory(Category category)
        {
            try
            {
                var json = JsonConvert.SerializeObject(category);
                var content = new StringContent(json, Encoding.UTF8, "application/json");

                var response = await _httpClient.PostAsync("categories", content);
                if (response.IsSuccessStatusCode)
                {
                    var responseContent = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<Category>>(responseContent);

                    if (apiResponse != null && apiResponse.success)
                    {
                        txtCategoryStatus.Text = "Category added successfully.";
                        txtCategoryStatus.Foreground = Brushes.Green;
                        LoadCategories();
                    }
                    else
                    {
                        txtCategoryStatus.Text = "Failed to add category.";
                        txtCategoryStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtCategoryStatus.Text = $"Error: {response.StatusCode}";
                    txtCategoryStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtCategoryStatus.Text = $"Error: {ex.Message}";
                txtCategoryStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void UpdateCategory(Category category)
        {
            try
            {
                var json = JsonConvert.SerializeObject(category);
                var content = new StringContent(json, Encoding.UTF8, "application/json");

                var response = await _httpClient.PutAsync($"categories/{category.id}", content);
                if (response.IsSuccessStatusCode)
                {
                    var responseContent = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<Category>>(responseContent);

                    if (apiResponse != null && apiResponse.success)
                    {
                        txtCategoryStatus.Text = "Category updated successfully.";
                        txtCategoryStatus.Foreground = Brushes.Green;
                        LoadCategories();
                    }
                    else
                    {
                        txtCategoryStatus.Text = "Failed to update category.";
                        txtCategoryStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtCategoryStatus.Text = $"Error: {response.StatusCode}";
                    txtCategoryStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtCategoryStatus.Text = $"Error: {ex.Message}";
                txtCategoryStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        private async void DeleteCategory(int id)
        {
            try
            {
                var response = await _httpClient.DeleteAsync($"categories/{id}");
                if (response.IsSuccessStatusCode)
                {
                    var content = await response.Content.ReadAsStringAsync();
                    var apiResponse = JsonConvert.DeserializeObject<ApiResponse<object>>(content);

                    if (apiResponse != null && apiResponse.success)
                    {
                        txtCategoryStatus.Text = "Category deleted successfully.";
                        txtCategoryStatus.Foreground = Brushes.Green;
                        LoadCategories();
                    }
                    else
                    {
                        txtCategoryStatus.Text = "Failed to delete category.";
                        txtCategoryStatus.Foreground = Brushes.Red;
                    }
                }
                else
                {
                    txtCategoryStatus.Text = $"Error: {response.StatusCode}";
                    txtCategoryStatus.Foreground = Brushes.Red;
                }
            }
            catch (Exception ex)
            {
                txtCategoryStatus.Text = $"Error: {ex.Message}";
                txtCategoryStatus.Foreground = Brushes.Red;
                MessageBox.Show($"Exception details: {ex}", "Error", MessageBoxButton.OK, MessageBoxImage.Error);
            }
        }

        #endregion
    }
}
