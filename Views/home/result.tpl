
<div class="row">
  <div class="col s12">
    <div class="clean100"></div>
    <table>
      <thead>
        <tr>
          <th width="50%">Original Link</th>
          <th>Shorten Link</th>
          <th>Analytics Data</th>
        </tr>
      </thead>
      <tbody id ="tbody">
      </tbody>
    </table>
  </div>
</div>
<script src="{$pathPublic}js/result.js"></script>
<script type="text/javascript">
if(!hasInLocalStorage({$data})){
  addNewRecord({$data});
}
printRecords();
removeOlderRecord();
</script>
