verbose(true)

TARGET = '/Users/dryan/Sites/madama'
directory TARGET

task :default => :run

task :run => :deploy_to_apache do
  sh %{open '/Applications/Google Chrome.app' http://dhcp-10-111-55-50.kewr1.m.vonagenetworks.net/~dryan/madama/main2.html}
end

task :deploy_to_apache => TARGET do
  puts 'starting deploy to apache...'
  
  # empty directory
  FileList[TARGET+'/**/*'].each do |source|
    rm_rf source
  end
  
  # copy everything in public to ~/Sites/<some dir>
  FileList['public/**/*'].each do |source|
    cp_r source, TARGET, :verbose => true
  end
  
  Rake::Task["touch_cache"].execute
end

task :touch_cache do
  sh %{chmod 777 #{TARGET}/cache}
  #change the datetime of cache file to prior day
  FileList[TARGET+'/cache/**/*'].each do |cache_file|
    sh %{touch -t #{(Time.now - 60*60*24).strftime("%Y%m%d%I%M")} '#{cache_file}'}
    sh %{chmod 775 #{cache_file}}
  end
  
end