@props([
'statistics_number',
'statistics_title',
])

<tr class="dashboard-statictics-card border-r-big background-white">
    <th scope="col" class="fw-medium">{{$statistics_title}}</th>
    <td class="big-number fw-700 color-dark">{{$statistics_number}}</td>
</tr>
