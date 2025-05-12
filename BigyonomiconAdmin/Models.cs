using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BigyonomiconAdmin
{
    public class ApiResponse<T>
    {
        public bool success { get; set; }
        public T? data { get; set; }
        public string? message { get; set; }
    }

    public class Product
    {
        public int id { get; set; }
        public string? name { get; set; }
        public string? description { get; set; }
        public decimal price { get; set; }
        public string? image { get; set; }
        public string? option2_image { get; set; }
        public decimal rating { get; set; }
        public int rating_count { get; set; }
        public int category_id { get; set; }
        public int subcategory_id { get; set; }
        public Category? category { get; set; }
        public Category? subcategory { get; set; }
        public List<Comment>? comments { get; set; }
    }

    public class Category
    {
        public int id { get; set; }
        public string? name { get; set; }
        public string? type { get; set; }
        public int? parent_id { get; set; }
        public List<Category>? subcategories { get; set; }
        public List<Product>? products { get; set; }
        public List<Product>? productsAsSubcategory { get; set; }
    }

    public class Comment
    {
        public int id { get; set; }
        public int product_id { get; set; }
        public int user_id { get; set; }
        public string? content { get; set; }
        public int rating { get; set; }
        public User? user { get; set; }
    }

    public class User
    {
        public int id { get; set; }
        public string? name { get; set; }
        public string? email { get; set; }
    }
}
