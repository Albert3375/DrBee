import Payment from 'payment';

import {BASE_API_URL} from './api';

export const AdminURL = '/admin';
export const PaymentMethodsURL = {
    index: (id) => ``,
    add: `${BASE_API_URL}/addCard`,

};

export function formatMoney(number, decPlaces, decSep, thouSep) {
  decPlaces = isNaN((decPlaces = Math.abs(decPlaces))) ? 2 : decPlaces;

  decSep = typeof decSep === 'undefined' ? '.' : decSep;

  thouSep = typeof thouSep === 'undefined' ? ',' : thouSep;

  const sign = number < 0 ? '-' : '';

  const i = String(
    parseInt((number = Math.abs(Number(number) || 0).toFixed(decPlaces))),
  );

  const j = i.length > 3 ? i.length % 3 : 0;

  return (
    sign +
    (j ? i.substr(0, j) + thouSep : '') +
    i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, '$1' + thouSep) +
    (decPlaces
      ? decSep +
        Math.abs(number - i)
          .toFixed(decPlaces)
          .slice(2)
      : '')
  );
}

/**
 * Get image.
 * @param {string} route - Image relative route.
 */
export function getImage(route) {
  return `${BASE_API_URL}/${route}`;
}

function clearNumber(value = '') {
  return value.replace(/\D+/g, '');
}

export function formatCreditCardNumber(value) {
  if (!value) {
    return value;
  }

  const issuer = Payment.fns.cardType(value);
  const clearValue = clearNumber(value);
  let nextValue;

  switch (issuer) {
    case 'amex':
      nextValue = `${clearValue.slice(0, 4)} ${clearValue.slice(
        4,
        10,
      )} ${clearValue.slice(10, 15)}`;
      break;
    case 'dinersclub':
      nextValue = `${clearValue.slice(0, 4)} ${clearValue.slice(
        4,
        10,
      )} ${clearValue.slice(10, 14)}`;
      break;
    default:
      nextValue = `${clearValue.slice(0, 4)} ${clearValue.slice(
        4,
        8,
      )} ${clearValue.slice(8, 12)} ${clearValue.slice(12, 19)}`;
      break;
  }

  return nextValue.trim();
}

export function formatCVC(value, prevValue, allValues = {}) {
  const clearValue = clearNumber(value);
  let maxLength = 4;

  if (allValues.number) {
    const issuer = Payment.fns.cardType(allValues.number);
    maxLength = issuer === 'amex' ? 4 : 3;
  }

  return clearValue.slice(0, maxLength);
}

export function formatExpirationDate(value) {
  const clearValue = clearNumber(value);

  if (clearValue.length >= 3) {
    return `${clearValue.slice(0, 2)}/${clearValue.slice(2, 4)}`;
  }

  return clearValue;
}

export function formatFormData(data) {
  return Object.keys(data).map((d) => `${d}: ${data[d]}`);
}

export function tokenize({number, expiry, name, cvc}) {
  const [exp_month, exp_year] = expiry.split('/');

  return {
    card: {
      number: number.replace(/\s/g, ''),
      name,
      exp_month,
      exp_year,
      cvc,
    },
  };
}
