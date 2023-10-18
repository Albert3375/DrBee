/**
 * Base URL
 */
 export const BASE_URL = 'https://Zoofish.com/';

 /**
  * Base API URL.
  */
 export const BASE_API_URL = 'https://api.Zoofish.com';

 /**
  * API URL.
  */
 export const API_URL = `${BASE_API_URL}/api/v1`;

 /**
  * Addresses API routes.
  */
 export const AddressesAPI = {
   address: `${API_URL}/addresses`,

   addressById: (id) => `${API_URL}/addresses/${id}`,

   addressesByUserId: (user_id) => `${API_URL}/addresses/user/${user_id}`,
 };

 /**
  * Auth API URLs.
  */
 export const AuthAPI = {
   Login: `${API_URL}/login`,

   Register: `${API_URL}/register`,

   ResetPassword: `${API_URL}/password/email`,
 };

 /**
  * Banners API.
  */
 export const BannersAPI = {
   // Banners base URL
   index: `${API_URL}/banners`,

   // Banner by ID URL.
   byId: (id) => `${API_URL}/banners/${id}`,
 };

 /**
  * Categories API routes.
  */
 export const CategoriesAPI = {
   /**
    * Base URL.
    */
   base: `${API_URL}/categories`,

   /**
    * Category by ID URL.
    */
   categoryById: (id) => `${API_URL}/categories/${id}`,
 };

 /**
  * Contact API routes.
  */
 export const ContactAPI = {
   send: `${API_URL}/contact/send`,
 };

 export const ConektaAPI = {
   addCard: `${API_URL}/addCard`,

   addPaymentMethod: `${API_URL}/addPaymentMethod`,

   deleteCard: `${API_URL}/destroyCard`,

   getCardsByUser: (id) => `${API_URL}/getCardsByUser/${id}`,
 };

 /**
  * Orders API.
  */
 export const OrdersAPI = {
   index: `${API_URL}/orders`,

   orderById: (id) => `${API_URL}/orders/${id}`,

   BY_USER_ID: (id) => `${API_URL}/orders/user/${id}`,

   updateStatus: `${API_URL}/orders/update_status`,
 };

 /**
  * Order status API routes.
  */
 export const OrderStatusAPI = {
   OrderStatus: `${API_URL}/orderstatus`,
 };

 /**
  * Payment methods API.
  */
 export const PaymentMethodsAPI = {
   index: `${API_URL}/paymentmethod`,
 };

 /**
  * Products API.
  */
 export const ProductsAPI = {
   base: `${API_URL}/products`,
   activos: `${API_URL}/metrics/getProductsActive`,
   inactivos: `${API_URL}/metrics/getProductsInActive`,
   deliveryOrders: `${API_URL}/metrics/ordersDelivery`,
   ordersPending: `${API_URL}/metrics/ordersPending`,
   deliveryOrdersPerMonth: `${API_URL}/metrics/getOrdersPerMonth/`,
   totalPerMonth: `${API_URL}/metrics/getTotalSales/`,

   productById: (id) => `${API_URL}/products/${id}`,
   productByIdStatus: (id) => `${API_URL}/products/changeStatus/${id}`,

   productsByCategoryId: (category_id) =>
     `${API_URL}/products/category/${category_id}`,

   /**
    * Get products by Subcategory ID.
    */
   bySubcategoryId: (id) => `${API_URL}/products/getBySubcategory/${id}`,

   mostViewed: `${API_URL}/metrics/most_viewed_products`,

   dashboardInfo: `${API_URL}/dashboard`
 };

 /**
  * Shopping cart API.
  */
 export const ShoppingCartAPI = {
   index: `${API_URL}/shoppingcart`,

   addProduct: `${API_URL}/shoppingcart/add_product`,

   byUserId: (user_id) => `${API_URL}/shoppingcart/user/${user_id}`,

   deleteProduct: `${API_URL}/shoppingcart/remove_product`,

   emptyCart: (id) => `${API_URL}/shoppingcart/empty/${id}`,
 };

 /**
  * Subcategories API.
  */
 export const SubcategoriesAPI = {
   /**
    * Base URL.
    */
   index: `${API_URL}/subcategories`,

   /**
    * Subcategory by ID URL.
    */
   subcategoryById: (id) => `${API_URL}/subcategories/${id}`,

   /**
    * Subcategories by category ID URL.
    */
   subcategoriesByCategoryId: (category_id) =>
     `${API_URL}/subcategories/category/${category_id}`,
 };

 /**
  * Users API routes.
  */
 export const UsersAPI = {
   /**
    * Base URL.
    */
   index: `${API_URL}/users`,
   register: `${API_URL}/metrics/registered_customers`,

   /**
    * User detail by ID.
    */
   detailById: (id) => `${API_URL}/users/${id}`,
 };
