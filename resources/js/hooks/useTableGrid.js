export function useSearch(props, load) {

  // search
  let searchDebounceTimer;
  const setSearch = (e) => {
    // clear previous timer and set new
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
      load({search: e.target.value});
    }, 300);
  };

  // sort
  const setSort = (s) => { // "s" is abbreviation of "sort"
    // reverse direction if clicked twice on column
    let d = "asc";         // "d" is abbreviation of "direction"
    if (props.sort == s) {
      d = props.direction == "asc" ? "desc" : "asc";
    }
    load({direction: d, sort: s});
  };

  // filter
  const setFilter = (filter) => {
    load(filter);
  };

  return {
    setSearch,
    setSort,
    setFilter,
  };

}

