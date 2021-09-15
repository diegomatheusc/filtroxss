export const htmlPurify = (value = '') => {
  const regex = /[!@#$%^&<>"'¨¨*]/;
  return value.replace(regex, '');
};



// O regex server para associar a algum padrão.
