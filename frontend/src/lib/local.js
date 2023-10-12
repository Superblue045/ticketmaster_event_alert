export const toShortSentence = (str, kac, nokta) => {
 const maxLength = typeof kac === "number" ? kac : 14;
 if (str.length > maxLength) {
   str = str.substr(0, maxLength);
   str = nokta ? str + "..." : str;
 }
 return str;
};