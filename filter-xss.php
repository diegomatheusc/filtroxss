export const htmlPurify = (value = '') => {
  const regex = /[!@#$%^&<>"'¨¨*]/;
  return value.replace(regex, '');
};