export const BASE_URL = '/';

/**
 * Base API URL.
 */
export const BASE_API_URL = '/api';

/**
 * API URL.
 */
export const API_URL = `${BASE_API_URL}`;

export const ConektaAPI = {
    addCard: `${API_URL}/addCard`,

    addPaymentMethod: `${API_URL}/addPaymentMethod`,

    deleteCard: `${API_URL}/destroyCard`,

    getCardsByUser: (id) => `${API_URL}/getCardsByUser/${id}`,
};
