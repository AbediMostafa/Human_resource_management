
const range = (start, stop, step) =>
    Array.from({length: (stop - start) / step + 1}, (_, i) => start + i * step);

const days = range(1, 31, 1);

const years = range(1330, 1400, 1);

export {days, years}