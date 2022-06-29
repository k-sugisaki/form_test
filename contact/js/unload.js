if (
  window?.performance
    ?.getEntriesByType("navigation")
    .map((nav) => nav.type)
    .includes("reload")
) {
  window.confirm(
    "このページから移動しますか？ 入力したデータは保存されません。"
  );
}
