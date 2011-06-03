verbose(true)

TARGET = '/Users/dennisryan/Sites/madama'
directory TARGET

task :default => :run

task :run => :deploy do
  sh %{open '/Applications/Google Chrome.app' http://dhcp-10-111-55-50.kewr1.m.vonagenetworks.net/~dryan/madama/main2.html}
end

task :deploy => TARGET do
  puts 'starting deploy to apache...'
  
  # empty directory
  FileList[TARGET+'/**/*'].each do |source|
    rm_rf source
  end
  
  cp_r 'public/.', TARGET
  
  Rake::Task["touch_cache"].execute
end

task :touch_cache => TARGET+"/cache" do
  mkdir TARGET+"/cache"
  
  sh %{chmod 777 #{TARGET}/cache}
  #change the datetime of cache file to prior day
  FileList[TARGET+'/cache/**/*'].each do |cache_file|
    sh %{touch -t #{(Time.now - 60*60*24).strftime("%Y%m%d%I%M")} '#{cache_file}'}
    sh %{chmod 775 #{cache_file}}
  end  
end