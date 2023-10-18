/**
 * Root URL routes.
 */
export const RootURL = '/';

/**
 * Admin URL route.
 */
export const AdminURL = '/admin';

/**
 * User addresses URL routes.
 */
export const AddressesURL = {
  index: `${AdminURL}/addresses`,

  add: `${AdminURL}/addresses/add`,
};

/**
 * Admin Products URL routes.
 */
export const AdminProductsURL = {
  index: `${AdminURL}/products`,

  add: `${AdminURL}/products/add`,

  info: (id) => `${AdminURL}/products/${id}`,

  edit: (id) => `${AdminURL}/products/${id}/edit`,
};

export const AdminBannersURL = {
  index: `${AdminURL}/banners`,

  create: `${AdminURL}/banners/add`,

  show: (id) => `${AdminURL}/banners/${id}`,
};

export const PaymentMethodsURL = {
  index: `${AdminURL}/payment_methods`,

  add: `${AdminURL}/payment_methods/add`,
};

/**
 * Categories URL routes.
 */
export const CategoriesURL = {
  /**
   * Base URL.
   */
  index: '/admin/categories',

  categoryById: (id) => `/admin/categories/${id}`,
  subCategoryById: (id) => `/admin/subcategories/${id}`,
};

/**
 * Orders URL routes.
 */
export const OrdersURL = {
  index: '/admin/orders',

  detail: (id) => `/admin/orders/${id}`,
};

/**
 * Products URL routes.
 */
export const ProductsURL = {
  index: '/products',

  info: (id) => `/products/${id}`,
};

/**
 * Users URL routes.
 */
export const UsersRoute = {
  index: '/admin/users',

  detailById: (id) => `/admin/users/${id}`,
};
