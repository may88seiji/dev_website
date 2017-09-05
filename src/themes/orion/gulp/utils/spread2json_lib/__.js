/**
 * get translation data
 */
export default function (key, option) {
  return String(translation[key]) || false;
};